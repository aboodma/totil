@extends('layouts.website')
@section('style')
    <style>
        .menu-item {
            color: #000;
            font-size: 14px;
        }

        .active-menu {
            font-weight: bolder;
            color: #04808B !important;
        }

    </style>
@endsection
@section('content')
    <div class="main-page second py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    @include('parts.customer_sidebar')
                </div>
                <div class="col-lg-8 right">
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="card-body shadow p-3 mb-4 bg-white rounded">
                                <h4 class="pb-2 pr-2">{{__('Activate Premium')}}</h4>

                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{route('customer.premium_activate')}}" method="POST">


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
                                                <p><b>20 USD</b></p>
                                            </div>
                                            <div class="row justify-content-between form-group ml-1 mr-1 mb-0">
                                                <p style="font-size: initial;color:#04808B"><b>{{__('Tax Fee')}}</b></p>
                                                <p style="color:#04808B"><b>10 USD</b></p>
                                            </div>
                                            <hr class="mt-0 pt-0">
                                            <div class="row justify-content-between form-group ml-1 mr-1 mb-0">
                                                <h5><b>{{__('Total')}}</b></h5>
                                                <h5><b>{{20 + 10}} USD</b></h5>
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
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
