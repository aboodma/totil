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
                        <h5 class="mb-4 font-weight-bold text-center">{{__('Create Live Book')}}
                        </h5>
                        <div class="row ">
                            <div class="col-md-12  ">
                                <form method="post" action="{{route('provider.store_live_book')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Book Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Book Title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Book Description</label>
                                        <textarea name="description" class="form-control" id="" cols="30" rows="5" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Book Cover</label>
                                        <input type="file" name="book_cover" id="book_cover" class="form-control" required placeholder="Book Cover">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary form-control" type="submit">Create </button>
                                    </div>

                                </form>
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
