@extends('layouts.backend')
@section('page_header','Languages List')
@section('page_toolbar')

@endsection
@section('content')

<div class="content flex-column-fluid" id="kt_content">
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Languages
                </h3>
            </div>
            
        </div>
        <div class="card-body">

            <!--begin: Datatable-->
            <table class="table table-bordered table-checkable" id="kt_datatable">
                <thead>
                    <tr>
                        <th title="Field #1">Key</th>
                        <th title="Field #2">Value </th>
                        
                    </tr>
                </thead>
                <form action="{{route('admin.language.update',$language->id)}}" method="POST">
                    @csrf
                <tbody>
                    @foreach ($content as $key => $value)
                    <tr>
                        <td>{{$key}}</td>
                        <td><input type="text" class="form-control" name="data[{{$key}}]" value="{{$value}}"></td>
                        
                    </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td><button type="submit" class="btn btn-success form-control">Save</button></td>
                    </tr>
                </tfoot>
            </form>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
</div>
<!--end::Content-->
@endsection


@section('script')
  
@endsection
