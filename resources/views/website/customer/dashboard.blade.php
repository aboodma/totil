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
                        <h4 class="pb-2 pr-2">{{__('Current Active Orders')}}</h4>

                          <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="example" class="table  " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>{{__('Service Name / Provider Name')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Option')}}</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (auth()->user()->orders->where('status',0)->take(5) as $order)
                                            <tr>
                                                <td>{{$order->service->name}} / {{$order->provider->user->name}}</td>
                                                <td>@if ($order->status == 0)
                                                    <span class="badge badge-warning">{{__('Pending')}}</span>
                                                    @elseif($order->status == 1)
                                                    <span class="badge badge-warning">{{__('Accepted')}}</span>
                                                    @elseif($order->status == 2)
                                                    <span class="badge badge-success">{{__('Completed')}}</span>
                                                    @elseif($order->status == 3)
                                                    <span class="badge badge-danger">{{__('Rejected')}}</span>
                                                    @endif</td>
                                                <td><a href="{{route('customer.OrderTracking',Crypt::encrypt($order->id))}}"
                                                    class="btn btn-info"> {{__('Order Tracking')}} <i class="fa fa-eye"></i>
                                                </a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                   </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                    <div class="row "> 
                        <div class="col-md-12">
                            <div class="card-body shadow p-3 mb-4 bg-white rounded">
                            <h4 class="pb-2 pr-2">{{__('My Favorit List')}}</h4>

                              <div class="row">
                                @foreach(auth()->user()->favorits as $favorit)
                                <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-6 col-6">
                                    <div class="freelancer">
                                        <div>
                                            <div class="top-right p-1 text-center">
                                            </div>
                                            <a href="{{route('provider_profile',$favorit->provider->id)}}">
                                            <img src="{{asset($favorit->provider->user->avatar)}}">
                                        </a>
                                        </div>
                                        <a href="{{route('provider_profile',$favorit->provider->id)}}">
                                        <div class="freelancer-footer">
                    
                                            <h5 style="padding: 0px;">{{$favorit->provider->user->name}}
                                                <span style="font-size: 12px">{{ucfirst(strtolower($favorit->provider->ProviderType->name))}}
                                                    <br>
                                                    {{ucfirst(strtolower($favorit->provider->Country->name))}}</span>
                                            </h5>
                                        </div>
                                    </a>
                                    </div>
                                </div>
                                @endforeach
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body shadow p-3 mb-4 bg-white rounded">
                            <h4 class="pb-2 pr-2">{{__('My Videos')}}</h4>
                              <div class="row">
                                @foreach (auth()->user()->orders as $order) 
                                @if ($order->service->is_video) 
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-6">
                                        <div class="freelancer" >
                                            <video style="width: 100%" controls>
                                                <source src="{{asset($order->details->provider_message)}}" type="video/mp4">
                                            </video>
                                            <div class="freelancer-footer">  
                                                <h5 style="padding: 0px;">
                                                    <span style="font-size: 12px"></span>
                                                </h5>
                                            </div>
                                        </div>
                                </div>
                                @endif
                                @endforeach
                              </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
