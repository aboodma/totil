@extends('layouts.backend')
@section('page_header','Customers List')
@section('style')

<link rel="stylesheet" href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}">
@endsection
@section('page_toolbar')


@endsection
@section('content')

<div class="content flex-column-fluid" id="kt_content">
  
    <table class="table table-separate table-head-custom table-checkable dataTable no-footer dtr-inline collapsed"  id="kt_datatable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Orders </th>
                <th>Options </th>
             
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->orders->count()}}</td>
                <td>
                   
                    <form action="{{route('admin.users.customers_destroy',$user->id)}}" method="POST">
                        @csrf
                        @method("DELETE")
                    <a href="{{route('admin.users.customers_show',$user->id)}}" class="btn btn-primary btn-icon btn-sm"> <i class="fas fa-eye"></i> </a>
                    <a href="{{route('admin.users.customers_edit',$user->id)}}" class="btn btn-sm btn-warning font-weight-bolder text-uppercase btn-icon btn-sm"><i class="fas fa-edit"></i></a>
                       
                        <button type="submit" class="btn btn-sm btn-danger font-weight-bolder text-uppercase mr-3 btn-icon btn-sm"><i class="fas fa-trash"></i></button>
               
                </form>
            </tr>
            
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Orders </th>
                <th>Options </th>
            </tr>
        </tfoot>
       </table>

</div>
<!--end::Content-->
@endsection


@section('script')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script>
    var KTDatatablesBasicBasic = function() {
    var initTable = function () {
        var table = $('#kt_datatable');
        table.DataTable({
            responsive:true,
            orderable:true
        })
    }
    return {
        init: function() {
			initTable();
		
		}
    }
}();
    jQuery(document).ready(function() {
	KTDatatablesBasicBasic.init();
});

</script>

@endsection