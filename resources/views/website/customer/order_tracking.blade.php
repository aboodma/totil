@extends('layouts.website')
@section('style')
<style>
    .menu-item {
        color: #000;
        font-size: 14px;
    }

    .active-menu {
        font-weight: bolder;
        color: #d47fa6 !important;
    }
    .timeline {
  list-style-type: none;
  display: flex;
  align-items: center;
  justify-content: center; }

.li {
  transition: all 200ms ease-in; }

.timestamp {
  margin-bottom: 20px;
  padding: 0px 40px;
  display: flex;
  flex-direction: column;
  align-items: center;
  font-weight: 100; }

.status {
  padding: 0px 40px;
  display: flex;
  justify-content: center;
  border-top: 2px solid #D6DCE0;
  position: relative;
  transition: all 200ms ease-in; }
  .status h4 {
    font-weight: 600; }
  .status:before {
    content: '';
    width: 25px;
    height: 25px;
    background-color: white;
    border-radius: 25px;
    border: 1px solid #ddd;
    position: absolute;
    top: -15px;
    left: 42%;
    transition: all 200ms ease-in; }

.li.complete .status {
  border-top: 2px solid #d47fa6; }
  .li.complete .status:before {
    background-color: #d47fa6;
    border: none;
    transition: all 200ms ease-in; }
  .li.reject .status h4 {
    color: red; }
    .li.reject .status {
  border-top: 2px solid red; }
  .li.reject .status:before {
    background-color: red;
    border: none;
    transition: all 200ms ease-in; }
  .li.reject .status h4 {
    color: red; }

    .li.disabled .status h4 {
    color: #acadae; }
    .li.disabled .status {
  border-top: 2px solid #acadae; }
  .li.disabled .status:before {
    background-color: #acadae;
    border: none;
    transition: all 200ms ease-in; }
  .li.disabled .status h4 {
    color: #acadae; }

@media (min-device-width: 320px) and (max-device-width: 700px) {
  .timeline {
    list-style-type: none;
    display: block; }
  .li {
    transition: all 200ms ease-in;
    display: flex;
    width: inherit; }
  .timestamp {
    width: 100px; }
  .status:before {
    left: -8%;
    top: 30%;
    transition: all 200ms ease-in; } }

    .status p {
      margin-top: 16px;
    }
    .title {
      color:#d47fa6;
      font-weight: 800;
    }
    .desc{
      font-weight: 600;
    }
    .gray{
      color:#A3A5A6;
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
                
                <div class="p-4 bg-white rounded shadow-sm mb-3">
                    <h5 class="mb-4 font-weight-bold text-center">{{__('My Orders')}}
                    </h5>
                    <div class="row">
                        <div class="col-md-12">
                            
                           
                            
                            <ul class="timeline" id="timeline">
                              <li class="li complete">
                                <div class="timestamp">
                                  
                                  
                                </div>
                                <div class="status">
                                  <p> {{__('Get The order')}} </p>
                                </div>
                              </li>
                             @if($order->status != 3)
                              <li class="li @if( $order->status == 1 || $order->status == 2) complete @endif">
                                <div class="timestamp">
                             
                                  
                                </div>
                                <div class="status">
                                  <p> {{__('Order Accepted')}} </p>
                                </div>
                              </li>
                              @else 
                              <li class="li @if( $order->status == 3) reject @endif">
                                <div class="timestamp">
                             
                                  
                                </div>
                                <div class="status">
                                  <p> {{__('Order Rejected')}} </p>
                                </div>
                              </li>
                              @endif
                              <li class="li @if( $order->status == 1 || $order->status == 2) complete @elseif($order->status == 3) disabled @endif">
                                <div class="timestamp">
                             
                                  
                                </div>
                                <div class="status">
                                  <p class=" @if( $order->status == 3) gray @endif"> {{__('In Process')}} </p>
                                </div>
                              </li>
                              <li class="li @if( $order->status == 2) complete @elseif($order->status == 3) disabled @endif">
                                <div class="timestamp">
                             
                                </div>
                                <div class="status">
                                  <p class=" @if( $order->status == 3) gray @endif" > {{__('Completed')}} </p>
                                </div>
                              </li>
                             </ul>      
                        </div>
                        <div class="col-md-12 mt-5">
                          <p><b class="title">{{__('Order Status :')}} </b>  <span class="desc">{{__('The Star Received Your order')}}</span></p>
                        </div>
                    </div> <hr>
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <legend>{{__('Order Details')}}</legend>

                        <div class="row">
                          <div class="col-md-3"><p class="title">{{__('From :')}}</p> </div>
                          <div class="col-md-6"><p class="desc">{{$order->details->from}}</p></div>
                        </div>
                        <div class="row">
                          <div class="col-md-3"><p class="title">{{__('To :')}}</p> </div>
                          <div class="col-md-6"><p class="desc">{{$order->details->to}}</p></div>
                        </div>
                        <div class="row">
                          <div class="col-md-3"><p class="title">{{__('Message  :')}}</p> </div>
                          <div class="col-md-6"><p class="desc">{{$order->details->customer_message}}</p></div>
                        </div>
                        <div class="row">
                          <div class="col-md-3"><p class="title">{{__('Date  :')}}</p> </div>
                          <div class="col-md-6"><p class="desc">{{$order->details->created_at}}</p></div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-md-3"><p class="title">{{__('Service Name  :')}}</p> </div>
                          <div class="col-md-6"><p class="desc">{{$order->service->name}}</p></div>
                        </div>
                        <div class="row">
                          <div class="col-md-3"><p class="title">{{__('Provider Name  :')}}</p> </div>
                          <div class="col-md-6"><p class="desc">{{$order->provider->user->name}}</p></div>
                        </div>
                        <hr>
                        
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection
