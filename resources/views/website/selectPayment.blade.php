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
        color: #04808B;
        border-color: #04808B;
        border-radius: 20px;
    }

    .pink-btn:hover {
        color: #fff !important;
        background-color: #04808B !important;
        border-color: #04808B !important;
    }

    .btn-big-pink {
        background-color: #04808B !important;
        border-color: #04808B !important;

    }


    .sec-btn {
        border-radius: 20px;
    }
    .rd-in {
        border-radius: 20px;
    }
    .payment{
        border: 2px solid #b3b1b1;
        border-radius: 5px;
        padding: 15px;
    }
    .selected{
        background-color: #d0d0d0;
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
                        <form action="{{route('checkPayment')}}" method="POST">
                            <input type="hidden" name="service_id" value="{{$request->service_id}}">
                            <input type="hidden" name="provider_id" value="{{$request->provider_id}}">
                            <input type="hidden" name="price" value="{{$request->price}}">
                            <input type="hidden" name="service_id" value="{{$request->service_id}}">
                            <input type="hidden" name="provider_id" value="{{$request->provider_id}}">
                            <input type="hidden" name="price" value="{{$request->price}}">
                            <input type="hidden" name="from" value="{{$request->from}}">
                            <input type="hidden" name="to" value="{{$request->to}}">
                            <input type="hidden" name="book_id" value="{{$request->book_id}}">
                            <input type="hidden" name="customer_message" value="{{$request->customer_message}}">
                            @csrf
                            <legend><b style="font-size: smaller;">{{__('Request an Order from')}} {{App\Provider::find($request->provider_id)->user->name}}{{__(' to :')}}</b></legend>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check payment selected" onclick="selectPayment(this)" id="wallet">
                                        <input class="form-check-input"  style="display: none" type="radio" name="payment_method" id="wallet_input" value="wallet" checked>
                                        <label class="form-check-label" for="wallet_input">
                                            <i class="fas fa-wallet mr-1"></i>   Pay By Wallet 
                                        </label>
                                        <b class="ml-1 float-right">Your Balance : {{auth()->user()->wallets->where('transaction_type',0)->sum('amount') - auth()->user()->wallets->where('transaction_type',1)->sum('amount')}} USD</b>
                                      </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check payment" onclick="selectPayment(this)" id="card">
                                        <input class="form-check-input"  style="display: none" type="radio" name="payment_method" id="card_input" value="card">
                                        <label class="form-check-label" for="card_input">
                                           <i class="fas fa-credit-card mr-1"></i>  Pay By Card  <img class="ml-1" width="100" src="{{asset('images/bank.png')}}" alt="">
                                        </label>
                                      </div>
                                </div>
                                

                                
                            </div>
                          

                            
                            <br>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success form-control">Next</button>
                                    </div>
                                </div>
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
        function selectPayment(e) {
           if(e.id == "wallet"){

            $("#wallet").toggleClass("selected");
            $("#card").toggleClass("selected");
            $("#wallet_input").attr("checked","checked");

           }else{
            $("#wallet").toggleClass("selected");
            $("#card").toggleClass("selected");
            $("#card_input").attr("checked","checked"); 
           }
        }
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
