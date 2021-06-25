@extends('layouts.website')
@section('style')
<style>
    .menu-item {
        color: #000;
        font-size: 14px;
    }

    .active-menu {
        font-weight: bolder;
        color: #04808B !important;
    }

</style>

@endsection
@section('content')
<div class="main-page second py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                @include('parts.provider_sidebar')
            </div>
            <div class="col-lg-8 right">
                <div class="p-4 bg-white rounded shadow-sm my-3">
                    <h6 class="mb-2 font-weight-bold">{{$providerService->service->name}}
                    </h6>

                    <div class="row">
                        <div class="col-md-12">
                            <p>{{$providerService->service->description}}</p>
                        </div>
                    </div>

                </div>
                <div class="p-4 bg-white rounded shadow-sm mb-3">
                    <h5 class="mb-4 font-weight-bold text-center">Edit Service
                    </h5>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('provider.update_service',$providerService->id)}}" method="POST">
                                @csrf
                              
                                <div class="form-group">
                                    <label for="">
                                        Price (USD)
                                    </label>
                                    <input type="number" class="form-control" value="{{$providerService->price}}" placeholder="Price (USD)" name="price">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary form-control">Save</button>
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

@endsection
