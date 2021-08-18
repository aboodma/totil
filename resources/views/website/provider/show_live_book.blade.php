
@extends('layouts.website')


@section('content')
    <div class="main-page second py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    @include('parts.provider_sidebar')
                </div>
                <div class="col-lg-8 right">

                    <div class="p-4 bg-white rounded shadow-sm mb-3">
                        <h5 class="mb-4 font-weight-bold text-center">{{$liveBook->name}}
                        </h5>
                        <div class="row ">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                    <tr>
                                        <th>Book Cover</th>
                                        <td><img src="{{asset($liveBook->cover)}}" style="width:50%" alt=""></td>
                                    </tr>
                                    <tr>
                                        <th>Book Title</th>
                                        <td>{{$liveBook->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Book Description</th>
                                        <td>{{$liveBook->description}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <h3 class="text-center"> Book Pages </h3>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Page Title</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($liveBook->pages as $page)
                                    <tr>
                                        <td>{{$page->id}}</td>
                                        <td>{{$page->title}}</td>
                                        <td>
                                            <div class="nowrap">
                                                <a href="{{route('provider.view_live_book_page',$page->id)}}" class="btn btn-primary">View <i class="fa fa-eye"></i> </a>
                                            </div>
                                        </td>
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

@endsection
@section('script')
    <script>

    </script>
@endsection
