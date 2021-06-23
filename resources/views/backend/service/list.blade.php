@extends('layouts.backend')
@section('page_header','Services List')
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
                <h3 class="card-label">Services
                </h3>
            </div>
            <div class="card-toolbar">
               
                <!--begin::Button-->
                <a href="{{route('admin.service_create')}}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <circle fill="#000000" cx="9" cy="15" r="6" />
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>New Record</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">

            <!--begin: Datatable-->
            <table class="table table-bordered table-checkable" id="kt_datatable">
                <thead>
                    <tr>
                        <th title="Field #1">#</th>
                        <th title="Field #2">Service Name </th>
                        <th title="Field #3">Service Description</th>
                        <th title="Field #4">Is Video</th>
                        <th title="Field #8">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                    <tr>
                        <td>{{$service->id}}</td>
                        <td>{{$service->name}}</td>
                        <td>{{$service->description}}</td>
                        <td>@if($service->is_video == 1) True @else False @endif </td>
                        <td>
                            <form action="{{route('admin.service_delete',$service->id)}}" method="post">
                            <div class="btn-group">
                                <a href="{{route('admin.service_edit',$service->id)}}" class="btn btn-sm btn-warning font-weight-bolder text-uppercase"> <i class="fa fa-edit"></i> Edit</a>
                                
                                    @csrf
                                    @method("DELETE")
                                                           
                                <button class="btn btn-sm btn-danger font-weight-bolder text-uppercase"> <i class="fa fa-trash"></i> delete</button>
                            </div>
                        </form>  
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