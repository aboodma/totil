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
            <div class="col-lg-4">
                @include('parts.provider_sidebar')
            </div>
            <div class="col-lg-8 right">


                <div class="row">
                    <div class="col-md-12">
                        <div class="bg-white rounded shadow-sm sidebar-page-right">
                            <div>
                                <div class="card-body">
                                    <div class="row justify-content-around">
        
                                        <div class="col-md-3 text-center border-box">
                                            <p>{{__('Total Orders')}}</p>
                                            <h1 class="font-weight-bold m-0">{{auth()->user()->wallets->where('transaction_type',0)->sum('amount')}} USD</h1>
                                        </div>
                                       
                                        <div class="col-md-3 text-center border-box">
                                            <p> {{__('Wallet Balance')}} </p>
                                            <h1 class="font-weight-bold m-0">{{auth()->user()->wallets->where('transaction_type',0)->sum('amount') - auth()->user()->wallets->where('transaction_type',1)->sum('amount')}} USD</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col-md-12">
                        <div class="bg-white rounded shadow-sm sidebar-page-right ">
                            <div>
                                <div class="card-body">
                                   <div class="table-responsive">
                                    <table id="example" class="table  " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>{{__('Service Name / Customer Name')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Option')}}</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (auth()->user()->provider->orders->where('status',0)->take(5) as $order)
                                            <tr>
                                                <td>{{$order->service->name}} / {{$order->user->name}}</td>
                                                <td>@if ($order->status == 0)
                                                    <span class="badge badge-warning">{{__('Pending')}}</span>
                                                    @elseif($order->status == 1)
                                                    <span class="badge badge-warning">{{__('Accepted')}}</span>
                                                    @elseif($order->status == 2)
                                                    <span class="badge badge-success">{{__('Completed')}}</span>
                                                    @elseif($order->status == 3)
                                                    <span class="badge badge-danger">{{__('Rejected')}}</span>
                                                    @endif</td>
                                                <td><a href="{{route('provider.orders',"onGoing")}}"
                                                    class="btn btn-info"> {{__('View Orders')}} <i class="fa fa-eye"></i>
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

            </div>
        </div>
    </div>
</div>
@endsection
