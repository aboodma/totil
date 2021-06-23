@extends('layouts.backend')
@section('page_header','Orders List')
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@endsection
@section('page_toolbar')

@endsection
@section('content')

<div class="content flex-column-fluid" id="kt_content">
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Orders
                </h3>
            </div>
            
        </div>
        <div class="card-body">

            <!--begin: Datatable-->
            <table class="table table-checkable" id="kt_datatable">
                <thead>
                    <tr>
                        <th title="Field #1">#</th>
                        <th title="Field #2">Service  </th>
                        <th title="Field #3">Provider </th>
                        <th title="Field #4">Price</th>
                        <th title="Field #4">Status</th>
                        <th title="Field #4">Created At</th>
                        <th title="Field #8">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->service->name}}</td>
                        <td>{{$order->provider->user->name}}</td>
                        <td>{{$order->total_price}}</td>
                        <td>@if ($order->status == 0)
                            <span class="badge badge-warning">{{__('Pending')}}</span>
                            @elseif($order->status == 1)
                            <span class="badge badge-warning">{{__('Accepted')}}</span>
                            @elseif($order->status == 2)
                            <span class="badge badge-success">{{__('Completed')}}</span>
                            @elseif($order->status == 3)
                            <span class="badge badge-danger">{{__('Rejected')}}</span>
                            @endif</td>
                        <td>{{$order->created_at->diffForHumans()}}</td>
                        <td>
                            <a href="{{route('admin.orders.show',$order->id)}}" title="Track Order" class="btn btn-sm btn-icon btn-success"><i class="fa fa-eye"></i></a>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
</div>
<!--end::Content-->
@endsection


@section('script')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script>
      $("#kt_datatable").dataTable();
  </script>
@endsection
