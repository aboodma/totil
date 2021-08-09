@extends('layouts.website')
@section('title',$provider->user->name)
@section('style')
<link rel="stylesheet" href="{{asset('css/audio_player.css')}}">
<style>

    .liked{
        color: #1ac5d5 !important;
    }
    .toolbar2 {

        position: fixed;
        top: 30%;
        right: 0;
        list-style: none;
        margin: 0;
        z-index: 95;
        /*background: rgba(82, 63, 105, 0.15);*/
        -webkit-box-shadow: 0px 0px 50px 0px rgba(82, 63, 105, 0.15);
        box-shadow: 0px 0px 50px 0px rgba(82, 63, 105, 0.15);
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        border-top-left-radius: 0.42rem;
        border-bottom-left-radius: 0.42rem;
    }
    .toggle-panel-btn{
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
        padding: 10px;
    }


    /*-- Content Style --*/
    .post-footer-option li{
        float:left;
        margin-right:50px;
        padding-bottom:15px;
    }

    .post-footer-option li a{
        color:#AFB4BD;
        font-weight:500;

    }

    .photo-profile{
        border:1px solid #DDD;
    }

    .anchor-username h4{
        font-weight:bold;
    }

    .anchor-time{
        color:#ADB2BB;
        font-size:1.2rem;
    }

    .post-footer-comment-wrapper{
        background-color:#F6F7F8;
    }
</style>

<script src="https://unpkg.com/wavesurfer.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js" integrity="sha512-6+YN/9o9BWrk6wSfGxQGpt3EUK6XeHi6yeHV+TYD2GR0Sj/cggRpXr1BrAQf0as6XslxomMUxXp2vIl+fv0QRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection
@section('content')
    <!-- Modal -->
    <div class="modal fade  m-0 p-0 " style="height:100%; width:100%;min-width: 100%;min-height: 100%;" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog m-0 p-0" style="height:100%; width:100%;min-width: 100%;min-height: 100%;" role="document">
            <div class="modal-content" >

                <div class="modal-header" style="background-color: #04808b;">
                    <h5 class="modal-title text-light">Posts Timeline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> <i class="fa fa-arrow-alt-circle-left"></i> </span>
                    </button>
                </div>

                <div class="modal-body bg-light"  style="height:100vh;overflow:auto;">
                    <div class="container-fluid">
                        @foreach($provider->posts as $post)
                            <div class="row justify-content-md-center pt-2 pb-2">
                                <div class="col-md-6">
                                    <div class="card " >
                                        <div class="card-header">
                                            <div class="media">
                                                <div class="media-left p-2">
                                                    <a href="{{route('provider_profile',$post->provider->slug)}}">
                                                        <img class="media-object photo-profile" src="{{asset($post->provider->user->avatar)}}" width="40" height="40" alt="...">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <a href="{{route('provider_profile',$post->provider->slug)}}" class="anchor-username"><h5 class="media-heading">{{$post->provider->user->name}}</h5></a>
                                                    <a href="{{route('provider_profile',$post->provider->slug)}}" class="anchor-time">{{$post->created_at->diffForHumans()}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                        <img class="card-img-top" src="..." alt="Card image cap">--}}
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="card-text" style="color: {{$post->text_color}}">{{$post->body}}</p>

                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if($post->file != null && explode('.',$post->file)[1] == "jpg" || explode('.',$post->file)[1] == "png" || explode('.',$post->file)[1] == "webp" ||explode('.',$post->file)[1] == "jpeg" || explode('.',$post->file)[1] == "gif"  )
                                                        <img src="{{asset($post->file)}}" style="width:100%" alt="">
                                                    @endif
                                                    @if($post->file != null && explode('.',$post->file)[1] == "mp4")
                                                        <video src="{{asset($post->file)}}" controls></video>
                                                    @endif
                                                </div>
                                            </div>
                                            {{--                                            <a href="#" class="btn btn-primary">Go somewhere</a>--}}

                                        </div>
                                        <section class="post-footer">
                                            <hr>
                                            <div class="post-footer-option container">
                                                <ul class="list-unstyled">
                                                    <li><a id="post_{{$post->id}}_15987536912301023487954648" @auth
                                                        onclick="toggleLike({{$post->id}})"  href="javascript:void(0)"
                                                           @if(\App\ProviderPostLike::where(['user_id'=> auth()->user()->id,'provider_post_id'=>$post->id])->first())
                                                           class="liked"
                                                           @endif
                                                           @endauth
                                                           @guest href="{{route('login')}}" @endguest
                                                        ><i class="fa fa-thumbs-up"></i> Like</a></li>
                                                    <li><a href="javascript:void(0)"><i class="fa fa-comments"></i> Comment</a></li>

                                                </ul>
                                            </div>

                                        </section>
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="{{route('comment')}}" id="comment_form_{{$post->id}}_022206549874568791" method="post">

                                                        <div class="form-group">
                                                            <label class="" for="">
                                                                Your Comment
                                                            </label>
                                                            <textarea onkeypress="submiter({{$post->id}});" id="body_{{$post->id}}_54649861321984654"  name="body" style="resize: none; @if($post->background_class != "bg-light" && $post->background_class != "bg-white" && $post->background_class != null) border: none;@endif " class="form-control p-0 m-0 no-fo" id="" cols="30" rows="2"></textarea>
                                                            <small class=""> Press enter to submit</small>

                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row " id="Commenter_1455_{{$post->id}}">
                                                @foreach($post->comments as $comment)


                                                    <div class="col-md-12 bg-light border">
                                                        <p class="p-0 mb-0">{{$comment->user->name}}</p>

                                                        <p>{{$comment->body}}</p>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                    </div>

                </div>

            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->


<div class="services-wrapper bg-white py-5">

    <div class="container">
        <div class="row">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="{{route('welcome')}}">{{__('Home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('FilterByType',$provider->ProviderType->id)}}">{{_ti($provider->ProviderType->name)}}</a></li>
                <li class="breadcrumb-item active font-weight-bold" aria-current="page">{{$provider->user->name}}</li>
              </ol>
        </div>
        <div class="row d-inline d-none d-sm-block d-md-none">
            <div class="col-md-12">

                <h2 class="">{{$provider->user->name}} <i class="fas fa-check-circle text-primary" style="font-size: large;"></i>
                    @auth
                        <button type="button" class="btn btn-outline-danger pink-btn btn-borderless " data-toggle="modal" data-target="#reservationModal">
                            Make Reservation
                        </button>
                    @endauth
                    @guest
                        <a type="button" class="btn btn-outline-danger pink-btn btn-borderless " href="{{route('login')}}" >
                            Make Reservation
                        </a>
                    @endguest
                </h2>

            </div>
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
                        <h2 class="d-none d-lg-block">{{$provider->user->name}} <i class="fas fa-check-circle text-primary" style="font-size: large;"></i>
                            @auth
                            <button type="button" class="btn btn-outline-danger pink-btn btn-borderless " data-toggle="modal" data-target="#reservationModal">
                                Make Reservation
                            </button>
                            @endauth
                            @guest
                                <a type="button" class="btn btn-outline-danger pink-btn btn-borderless " href="{{route('login')}}" >
                                    Make Reservation
                                </a>
                                @endguest
                        </h2>
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
    <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="reservationModalLabel">{{__('Ask For Reservation')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body border-0" >
                    <div class="form-horizontal">
                        @auth
                            @if(auth()->user()->is_premium)
                        <form action="{{route('reservation_store')}}" method="post" class="form">
                                @csrf
                            <input type="hidden" name="provider_id" value="{{$provider->id}}">
                            <div class="form-group">
                                <label for="">Date</label>
                                <input type="date" class="datepicker form-control" value="{{date('Y-m-d', strtotime("+1 week"))}}" min="{{date('Y-m-d', strtotime("+1 week"))}}" name="date" id="date">
                            </div>
                            <div class="form-group">
                                    <label for="">Phone <small>example : +90 000 000 0000</small></label>
                                <input id="phone" name="phone" placeholder="+90 000 000 0000" type="tel" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Reservation Reason <small>(Please Explane The Reason in 60 Charecter)</small> </label>
                                <input maxlength="60" type="text" class="form-control" name="reservation_reason" >
                            </div>
                            <div class="form-group">
                                <label for="">Notes</label>
                                <textarea name="msg" id="" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-outline-primary form-control">Make Reservation</button>
                            </div>
                        </form>
                                @else
                                <p>Sorry , This Service Avalibale Just for Premium Account Start Your Premium From <a
                                        href="{{route('customer.premium_form')}}">Here</a> </p>
                                @endif
                        @endauth
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="toolbar2">
        <button type="button" class="btn btn-primary toggle-panel-btn" data-toggle="modal" data-target="#myModal"> <i class="fa fa-arrow-alt-circle-left"></i> </button>
    </div>
    @endsection
    @section('script')
    <script src="{{asset('js/amplitudejs/dist/amplitude.js')}}"></script>
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
