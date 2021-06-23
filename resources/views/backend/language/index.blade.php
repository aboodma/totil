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
                        <th title="Field #1">#</th>
                        <th title="Field #2">Language Name </th>
                        <th title="Field #3">Language Code</th>
                        <th title="Field #4">Language Diraction</th>
                        <th title="Field #8">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Language::all() as $language)
                    <tr>
                        <td>{{$language->id}}</td>
                        <td>{{$language->name}}</td>
                        <td>{{$language->locale}}</td>
                        <td>{{$language->dir }} </td>
                        <td>
                        <div class="btn-group">
                            <a class="btn btn-primary" href="{{route('admin.language.translate',$language->id)}}">
                                <i class="fas fa-language "></i>
                            </a>
                            <a class="btn btn-success" href="{{route('admin.language.inputs',$language->locale)}}">
                                <i class="fas fa-globe "></i>
                            </a>
                        </div>
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
  
@endsection
