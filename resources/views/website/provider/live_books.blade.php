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
                    <h5 class="mb-4 font-weight-bold text-center">{{__('My Live Books ')}}
                    </h5>
                    <div class="row ">
                        @foreach($books as $book)

                            <div class="col-md-4 ">
                                <div class="card" >
                                    <img class="card-img-top" style="width:100%" src="{{asset($book->cover)}}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$book->name}}</h5>
                                        <p class="card-text">{{$book->description}}</p>
                                        <p class="card-text">{{__('Status')}} : @if($book->publish) {{__('Published')}} @else {{__('Draft')}} @endif</p>
                                        <div class="row nowrap ">
                                            <a href="#" class="btn btn-danger">Delete <i class="fa fa-trash"></i> </a>
                                            <a href="{{route('provider.edit_live_book',$book->id)}}" class="btn btn-warning">Edit <i class="fa fa-edit"></i> </a>
                                            <a href="{{route('provider.show_live_book',$book->id)}}" class="btn btn-primary">View <i class="fa fa-eye"></i> </a>
                                            <a href="{{route('provider.create_live_book_page',$book->id)}}" class="btn btn-primary">Add Page <i class="fa fa-plus"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
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
