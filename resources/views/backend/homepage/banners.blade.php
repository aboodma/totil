@extends('layouts.backend')
@section('page_header','Banners List')
@section('page_toolbar')
    <a href="{{route('admin.homepage.banners.create')}}"
       class="btn btn-sm btn-primary font-weight-bolder text-uppercase">Create Banner</a>

@endsection
@section('content')

    <div class="content flex-column-fluid" id="kt_content">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Banners
                    </h3>
                </div>

            </div>
            <div class="card-body">

                <!--begin: Datatable-->
                <table class="table table-bordered table-checkable" id="kt_datatable">
                    <thead>
                    <tr>
                        <th title="Field #1">#</th>
                        <th title="Field #2">Text 1</th>
                        <th title="Field #2">Text 2</th>
                        <th title="Field #2">Button Text</th>
                        <th title="Field #2">Language</th>
                        <th title="Field #8">Option</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach (App\HomePageBanner::all() as $banner)
                        <tr>
                            <td>{{$banner->id}}</td>
                            <td>{{$banner->text_1}}</td>
                            <td>{{$banner->text_2}}</td>
                            <td>{{$banner->button_text}}</td>
                            <td>{{App\Language::where('locale',$banner->locale)->first()->name}}</td>

                            <td>
                                <div class="btn-group">
                                    <form action="{{route('admin.homepage.banners.destroy',$banner->id)}}"
                                          method="POST">

                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
