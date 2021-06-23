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
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}

input[type=number] {
    -moz-appearance:textfield; /* Firefox */
}
select {
  -webkit-appearance: none;
  -moz-appearance: none;
  background: transparent;
  background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
  background-repeat: no-repeat;
  background-position-x: 100%;
  background-position-y: 5px;
  border: 1px solid #dfdfdf;
  border-radius: 2px;
  
  padding: 1rem;
  padding-right: 2rem;
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
                        <form action="{{route('pay')}}" method="POST">
                            <input type="hidden" name="service_id" value="{{$request->service_id}}">
                            <input type="hidden" name="provider_id" value="{{$request->provider_id}}">
                            <input type="hidden" name="price" value="{{$request->price}}">
                            <input type="hidden" name="from" value="{{$request->from}}">
                            <input type="hidden" name="to" value="{{$request->to}}">
                            <input type="hidden" name="customer_message" value="{{$request->customer_message}}">

                            @csrf
                            <div class="form-group mb-4">
                                <legend class="mb-0"><b>{{__('Payment Inforamtions')}}</b></legend>
                            <small><b>{{__('Your card will not get charged until the video is complete')}} </b><br></small>
                            </div>
                            
                            <div class="form-group">
                                <label>
                                    {{__('Card Holder Name')}}
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control " required placeholder="Smith John" name="card_holder_name">
                                    <div class="input-group-btn">
                                          <span class="btn btn-default">
                                            <i class="fa fa-user-o"></i>
                                          </span>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="form-group">
                                <label for="">{{__('Card Number')}}</label>
                                <div class="input-group">
                                    <input type="number"  class="form-control " minlength="16" maxlength="16" placeholder="xxxx-xxxx-xxxx-xxxx-xxxx" name="card_number">
                                    <div class="input-group-btn">
                                        <span class="btn btn-default">
                                          <i class="fa fa-credit-card"></i>
                                        </span>
                                  </div>
                                </div>
                               
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">
                                            {{__('Exp.Month')}}
                                        </label>
                                        <div class="input-group">
                                            <select class="form-control " name="exp_month" id="" required>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            <div class="input-group-btn">
                                                <span class="btn btn-default">
                                                  <i class="fa fa-calendar"></i>
                                                </span>
                                          </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3 offset-md-1">
                                    <div class="form-group">
                                        <label for="">
                                            {{__('Exp.Year')}}
                                        </label>
                                        <div class="input-group">
                                            <select class="form-control " name="exp_month" id="" required>
                                                @for ($i = 2021; $i <= 2035; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            <div class="input-group-btn">
                                                <span class="btn btn-default">
                                                  <i class="fa fa-calendar"></i>
                                                </span>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 offset-md-1">
                                    <div class="form-group">
                                        <label for="">
                                            {{__('CVC')}}
                                        </label>
                                        <div class="input-group">
                                            <input type="number" name="cvc" class="form-control " required maxlength="3" id="">
                                        <div class="input-group-btn">
                                            <span class="btn btn-default">
                                              <i class="fa fa-credit-card-alt"></i>
                                            </span>
                                      </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                                <div class="row justify-content-between form-group ml-1 mr-1 mb-0">
                                    <p style="font-size: initial">{{__('Sub Total')}}</p>
                                    <p><b>{{$request->price}} USD</b></p>
                                </div>
                                <div class="row justify-content-between form-group ml-1 mr-1 mb-0">
                                    <p style="font-size: initial;color:#E30C5F"><b>{{__('Tax Fee')}}</b></p>
                                    <p style="color:#E30C5F"><b>10 USD</b></p>
                                </div>
                                <hr class="mt-0 pt-0">
                                <div class="row justify-content-between form-group ml-1 mr-1 mb-0">
                                    <h5><b>{{__('Total')}}</b></h5>
                                    <h5><b>{{$request->price + 10}} USD</b></h5>
                                </div>
                            
                              <br>
                              <div class="form-group">
                                  <button class="btn btn-success  btn-lg btn-block" type="submit">{{__('Pay')}}</button>
                                  <p style="font-size: smaller " class="pt-2">{{__('By Booking up you agree to Narabana')}} <a style="text-decoration: underline;color:#000" href=""><b>{{__('terms of service and Privacy Policy')}}</b></a></p>
                                    <img src="{{asset('images/bank.png')}}" alt="">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

                <img class="http://localhost/celebrate/narabana/public/images/video.png" src="" width="250" alt="">
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
