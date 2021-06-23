@extends('layouts.backend')
@section('page_header','Customers List')
@section('style')

@endsection
@section('page_toolbar')


@endsection
@section('content')

<div class="content flex-column-fluid" id="kt_content">
  
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <!--begin::Details-->
            <div class="d-flex mb-9">
                <!--begin: Pic-->
                <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                   
                    <div class="symbol symbol-50 symbol-lg-120 symbol-primary ">
                        <span class="font-size-h3 symbol-label font-weight-boldest">{{$user->name[0]}}</span>
                    </div>
                </div>
                <!--end::Pic-->
                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between flex-wrap mt-1">
                        <div class="d-flex mr-3">
                            <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{$user->name}}</a>
                        </div>
                        <div class="my-lg-0 my-3">
                            <form action="{{route('admin.users.customers_destroy',$user->id)}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-light-danger font-weight-bolder text-uppercase mr-3">Delete</button>
                       
                            <a href="{{route('admin.users.customers_edit',$user->id)}}" class="btn btn-sm btn-warning font-weight-bolder text-uppercase">Edit</a>
                        </form>
                        </div>
                    </div>
                    <!--end::Title-->
                    <!--begin::Content-->
                    <div class="d-flex flex-wrap justify-content-between mt-1">
                        <div class="d-flex flex-column flex-grow-1 pr-8">
                            <div class="d-flex flex-wrap mb-4">
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <i class="flaticon2-new-email mr-2 font-size-lg"></i>{{$user->email}}</a>
                                
                            </div>
                            <div class="d-flex flex-wrap mb-4">
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <i class="flaticon-piggy-bank mr-2 font-size-lg"></i>{{$user->orders->sum('total_price')}} USD</a>
                                
                            </div>
                            <div class="d-flex flex-wrap mb-4">
                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <i class="flaticon-confetti  mr-2 font-size-lg"></i>{{$user->favorits->count()}} Stars</a>
                                
                            </div>
                        </div>
                        
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->
           
            <!--begin::Items-->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Advance Table Widget 2-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Customer Orders</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">All orders that created by this user below</span>
                    </h3>
                    
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-2 pb-0 mt-n3">
                    <div class="tab-content mt-5" id="myTabTables11">
                      
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade show active" id="kt_tab_pane_11_3" role="tabpanel" aria-labelledby="kt_tab_pane_11_3">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                        <tr>
                                           
                                            <th class="p-0 min-w-200px"></th>
                                            <th class="p-0 min-w-100px"></th>
                                            
                                            <th class="p-0 min-w-110px"></th>
                                     
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->orders as $order)
                                        <tr>
                                            
                                            <td class="pl-0">
                                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$order->service->name}}</a>
                                                <div>
                                                    <span class="font-weight-bolder">Provider name:</span>
                                                    <a class="text-muted font-weight-bold text-hover-primary" href="#">{{$order->provider->user->name}}</a>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$order->total_price}} USD</span>
                                                <span class="text-muted font-weight-bold">Paid</span>
                                            </td>
                                            
                                            <td class="text-right">
                                                <span class="label label-lg label-light-primary label-inline">@if ($order->status == 0)
                                               {{__('Pending')}}
                                                    @elseif($order->status == 1)
                                                   {{__('Accepted')}}
                                                    @elseif($order->status == 2)
                                                    {{__('Completed')}}
                                                    @elseif($order->status == 3)
                                                   {{__('Rejected')}}
                                                    @endif
                                            </td>
                                           
                                        </tr>
                                   @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Tap pane-->
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Advance Table Widget 2-->
        </div>
        
    </div>

</div>
<!--end::Content-->
@endsection


@section('script')


@endsection