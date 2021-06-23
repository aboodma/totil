@extends('layouts.website')
@section('style')
<style>
    .bak {
        background: #2a4d6c69;
        width: 100%;
        background-size: cover;
        height: 100%;
        position: absolute;
    }

    .pink-btn {
        color: #d47fa6;
        border-color: #d47fa6;
        border-radius: 20px;
    }

    .pink-btn:hover {
        color: #fff !important;
        background-color: #d47fa6 !important;
        border-color: #d47fa6 !important;
    }

    .btn-big-pink {
        background-color: #d47fa6 !important;
        border-color: #d47fa6 !important;

    }


    .sec-btn {
        border-radius: 20px;
    }
    .rd-in {
        border-radius: 20px;
    }

</style>
@endsection
@section('content')


<div class="services-wrapper bg-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('payment_info')}}" method="POST">
                            <input type="hidden" name="service_id" value="{{$request->service_id}}">
                            <input type="hidden" name="provider_id" value="{{$request->provider_id}}">
                            <input type="hidden" name="price" value="{{$request->price}}">
                            @csrf
                            <legend><b style="font-size: smaller;">{{__('Request an Order from')}} {{App\Provider::find($request->provider_id)->user->name}}{{__(' to :')}}</b></legend>
                            <div class="form-group">
                                <label for="">
                                    {{__('From')}}
                                </label>
                                <input type="text" class="form-control " name="from" required>
             
                            </div>
                            <div class="form-group">
                                <label for="">{{__('To')}}</label>
                                <input type="text" class="form-control " name="to" required>
             
                            </div>
                            <div class="form-group">
                                <label for="">{{__('Message')}}</label>
                                <textarea name="customer_message" class="form-control " id="" cols="30" rows="5" minlength="10" maxlength="250" required></textarea>
             
                            </div>
                            <hr>
                            <div class="form-check">
                                <input class="form-check-input" name="is_public" type="checkbox" value="1" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{__('Make this video public on our platform')}}
                                </label>
                              </div>
                              <br>
                              <div class="form-group">
                                  <button class="btn btn-success  btn-lg btn-block" type="submit">{{__('Proceed to payment')}}</button>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

                <img src="{{asset(App\Provider::find($request->provider_id)->user->avatar)}}"  width="250" alt="">
            </div>
           
        </div>
     
    </div>







    @endsection
    @section('script')
    <script>
         function select_service(service_id,e) {
              $.ajax({
                  url:"{{route('service_check')}}",
                  type:"GET",
                data:{service_id:service_id},
                  success : function (re) {
                      $(".price").html(re.price + " USD");
                      $("#price").val(re.price);
                  }
              });
                $("#"+e.id).parent().toggleClass('active');
            }
        $(document).ready(function () {

            $('.freelance-slider').slick({
                infinite: true,
                slidesToShow: 5,
                slidesToScroll: 3,
                dir: "ltr",
                centerMode: true,
                centerPadding: '60px',
                // adaptiveHeight: true,

            });

           

        })
        //   freelance-slider

    </script>
    @endsection
