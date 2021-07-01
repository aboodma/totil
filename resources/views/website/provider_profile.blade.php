@extends('layouts.website')
@section('title',$provider->user->name)
@section('style')
<style>
    .slick-track{
        float: left;
    }
</style>

<script src="https://unpkg.com/wavesurfer.js"></script>


@endsection
@section('content')
<div class="services-wrapper bg-white py-5">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="{{route('welcome')}}">{{__('Home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('FilterByType',$provider->ProviderType->id)}}">{{_ti($provider->ProviderType->name)}}</a></li>
                <li class="breadcrumb-item active font-weight-bold" aria-current="page">{{$provider->user->name}}</li>
              </ol>
        </div>
        <div class="row">
            <div class="col-md-3">
                <img style="position: absolute;
                width: 30%;
                align-self: center;
                top: 84%;
                filter: brightness(100);
                float: right;
                right: 7%;
                " src="{{asset('images/logo.png')}}" alt="">

                <video
               
                id="v-{{$provider->id}}" style="width: 100%" loop preload="false" autoplay="true"   tabindex="0">
                    
                    <source src="{{asset($provider->video)}}" type="video/mp4">
                </video>
                <span id="play-{{$provider->id}}" onclick="playVideo('{{$provider->id}}')" class="fa fa-play play-btn" ></span>
                <span id="pause-{{$provider->id}}" onclick="pauseVideo('{{$provider->id}}')" class="fa fa-pause pause-btn" ></span>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="mb-0 pb-0
                        ">{{$provider->user->name}}</h2>
                        <span class="pb-2 mb-2">{{_ti($provider->Country->name)}} / {{_ti($provider->ProviderType->name)}}</span>
                        <p class="pt-2">{{$provider->about_me}}</p>
                        <p style="font-weight: bold;color: #04808B;"><i class="fa fa-clock-o" style="color: #04808B;font-size: initial;"></i> {{__('Replies in 5 days')}}</p>
                        @if($provider->orders->whereIn('id',\App\OrderReview::pluck('order_id'))->count() != 0)
                        <p> <i class="fa fa-star @if($provider->orders->whereIn('id',\App\OrderReview::pluck('order_id'))->first()->rate->rate >= 1) text-warning @endif"></i> 
                                <i class="fa fa-star @if($provider->orders->whereIn('id',\App\OrderReview::pluck('order_id'))->first()->rate->rate >= 2) text-warning @endif"></i>
                                <i class="fa fa-star @if($provider->orders->whereIn('id',\App\OrderReview::pluck('order_id'))->first()->rate->rate >= 3) text-warning @endif"></i> 
                                <i class="fa fa-star @if($provider->orders->whereIn('id',\App\OrderReview::pluck('order_id'))->first()->rate->rate >= 4) text-warning @endif"></i>
                                <i class="fa fa-star @if($provider->orders->whereIn('id',\App\OrderReview::pluck('order_id'))->first()->rate->rate == 5) text-warning @endif"></i>
                                / <span class="font-weight-bold">{{$provider->orders->whereIn('id',\App\OrderReview::pluck('order_id'))->first()->rate->rate}} {{__('Star')}} </span>    
                            </p>
                        <p class="font-weight-bold" style="text-decoration:underline; font-size:14px; color:black"><a style="color:black" href="#" data-toggle="modal" data-target="#exampleModal">{{__('Show More Reviews')}} ({{$provider->orders->whereIn('id',\App\OrderReview::pluck('order_id'))->count()}})</a></p>
                            @else 
                            <p> <i class="fa fa-star "></i> 
                                <i class="fa fa-star "></i>
                                <i class="fa fa-star "></i> 
                                <i class="fa fa-star "></i>
                                <i class="fa fa-star "></i>
                                / <span class="font-weight-bold">{{__('0 Star')}} </span>    
                            </p>
                        <p class="font-weight-bold" style="text-decoration:underline; font-size:14px; color:black"><a style="color:black" href="#">{{__('Show More Reviews (0)')}}</a></p>

                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 copyright p-2 pb-3" >
                                <ul class="social " style="margin-left: 0">
                                    @if($provider->links_fb != null)
                                    <li>
                                        <a href="{{$provider->links_fb}}"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                    </li>
                                    @endif
                                    @if($provider->links_tweet != null)
                                    <li>
                                        <a href="{{$provider->links_tweet}}"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                    </li>
                                    @endif
                                    @if($provider->links_youtube != null)
                                    <li>
                                        <a href="{{$provider->links_youtube}}"><i class="fab fa-youtube" aria-hidden="true"></i></a>
                                    </li>
                                    @endif
                                    @if($provider->links_tiktok != null)
                                    <li>
                                        <a href="{{$provider->links_tiktok}}"><i class="fab fa-tiktok" aria-hidden="true"></i></a>
                                    </li>
                                    @endif
                                    @if($provider->links_ig != null)
                                    <li>
                                        <a href="{{$provider->links_ig}}"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="row books-slider "  data-toggle="inputs">
                            @foreach ($provider->books as $book)
                            <div class="col">
                                <label>
                                    <input type="radio" style="display: none" class="book_select" onchange="selectBook({{$book->id}})"  name="book_id" value="{{$book->id}}"   >
                                    <div class="freelancer book  p-2 @if($loop->first) active-book @endif" id="book_{{$book->id}}" >
                                        <div>
                                            <div class="top-right p-1 text-center">
                                                <span class="fa fa-heart-o"></span>
                                            </div>
                                            
                                            <img src="{{asset($book->cover_path)}}">
                                        </div>
                
                                        <div class="freelancer-footer">
                
                                            <h5 style="padding: 0px;">{{$book->title}}
                                                <span style="font-size: 12px">
                                                    <br>
                                                    </span>
                                            </h5>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                  
                    <div class="col-md-12">
                        <br>
                        <form action="{{route('selectPayment')}}" method="POST">
                            <input type="hidden" name="price" id="price">
                            <input type="hidden" name="from" value="none">
                            <input type="hidden" name="to" value="none">
                            <input type="hidden" name="customer_message" value="none">
                            <input type="hidden" id="provider_id" name="provider_id" value="{{$provider->id}}">
                            <input type="hidden" id="book_id" name="book_id" value="">
                            @csrf
                        <div class="row" id="BookServices" >
                           
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit"
                           
                                class="btn  btn-success  btn-xlg form-control rd-in  p-2 mt-3 ">{{__('Book Now')}} <i class="price"></i> </button>
                        </div>
                    </form>
                    </div>


                </div>

                
                {{-- <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('checkout')}}" method="POST">
                            <input type="hidden" name="price" id="price">
                            <input type="hidden" id="provider_id" name="provider_id" value="{{$provider->id}}">
                            @csrf
                            <div class=" btn-group-toggle" data-toggle="buttons">
                                @foreach ($provider->services as $service)
                                    <label class="btn btn-outline-success service_select @if($loop->first) active @endif" id="{{$service->Service->id}}">
                                      <input type="radio" class="service_select" @if($loop->first) checked @endif value="{{$service->Service->id}}" name="service_id" id="{{$service->Service->id}}"  > {{_ti($service->Service->name)}}
                                    </label>
                                @endforeach
                            </div>
                            <br>
                            <div class="form-group bg-light rounded p-1 "id="description_row" style="display: none">
                           
                    
                                    <h5>{{__('Service Descrption')}}</h5>
                                    <p id="description" class=""></p>
                                
                     
                            </div>
                            
                    </div>
                </div>  --}}
                
            </div>
        </div>
      
        <div class="freelance-projects bg-white py-5">
            <div class="container">
                <h1>{{_ti($provider->ProviderType->name)}}</h1>
                <div class="row freelance-slider">
                    @foreach (\App\Provider::where('provider_type_id',$provider->ProviderType->id)->get()->take(10) as $provider)
                    <div class="col">
                        <a href="{{route('provider_profile',$provider->slug)}}">
                            <div class="freelancer ">
                                <div>
                                    <div class="top-right p-1 text-center">
                                        <span class="fa fa-heart-o"></span>
                                    </div>
                                    @if($provider->services()->exists())
                                    <div class="bottom-left p-1">
                                        <span>{{$provider->services->first()->price}} USD</span> <i class="fa fa-video-camera"></i>
            
                                    </div>
                                    @endif
                                    <img src="{{asset($provider->user->avatar)}}">
                                </div>
        
                                <div class="freelancer-footer">
        
                                    <h5 style="padding: 0px;">{{$provider->user->name}}
                                        <span style="font-size: 12px">{{ucfirst(strtolower(_ti($provider->ProviderType->name)))}}
                                            <br>
                                            {{ucfirst(strtolower(_ti($provider->Country->name)))}}</span>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header border-0">
              <h5 class="modal-title" id="exampleModalLabel">{{__('Reviews')}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body border-0" id="reviews-modal_body">
              
            </div>
            
          </div>
        </div>
      </div>
    @endsection
    @section('script')


  <script>
        
        function selectBook(id){
            $(".book").removeClass("active-book");
            $("#book_"+id).addClass("active-book");
            $.ajax({
                url: "{{route('book_show')}}",
                type:"POST",
                data: {"_token":"{{csrf_token()}}","book_id":id},
                success : function(data){
                  $("#BookServices").html(data);
                  $("#book_id").val(id);
                }
            })
           }

        $('#exampleModal').on('show.bs.modal', function (event) {
            $.ajax({
                url:"{{route('reviews')}}",
                type:"POST",
                data:{"_token":"{{csrf_token()}}","provider_id":$("#provider_id").val()},
                success : function(res){
                    $("#reviews-modal_body").html("");

                    $("#reviews-modal_body").html(res);
                }
            });
        })
        function checkers() {
           
    $.ajax({
             url:"{{route('service_check')}}",
             type:"GET",
           data:{service_id:$('input[name="service_id"]:checked').val(),provider_id:$("#book_id").val()},
             success : function (re) {
                 $(".price").html(re.providerService.price + " USD");
                  $("#service_description").html(re.providerService.service.description)
               
                 $("#price").val(re.providerService.price);
             }
         });
                
            }
        $(document).ready(function () {
           selectBook($('.active-book').attr("id").split("_")[1]);
           
            $('.freelance-slider').slick({
                infinite: true,
                slidesToShow: 5,
                slidesToScroll: 3,
                dir: "ltr",
                centerMode: false,
                // centerPadding: '60px',
                // adaptiveHeight: true,
                responsive:[
                    {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                    },
                    {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                    },
                    {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                    }
                ]
            });
            $('.books-slider').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 2,
                dir: "ltr",
                centerMode: false,
                // centerPadding: '60px',
                // adaptiveHeight: true,
                responsive:[
                    {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                    },
                    {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                    },
                    {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                    }
                ]
            });
            
           

        
        });
     
        //   freelance-slider
        function playVideo(id) {
            var vid =$("#v-"+id); 
            var play_i =$("#play-"+id);
            var pause_i =$("#pause-"+id);
            play_i.hide();
            pause_i.show();

            $("#v-"+id).get(0).play();
                }
        function pauseVideo(id) {
            var vid =$("#v-"+id); 
            var play_i =$("#play-"+id);
            var pause_i =$("#pause-"+id);
            play_i.show();
            pause_i.hide();

            $("#v-"+id).get(0).pause();
        }
    </script>
    @endsection
