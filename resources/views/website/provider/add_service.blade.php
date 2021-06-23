@extends('layouts.website')
@section('style')
<style>
    .menu-item {
        color: #000;
        font-size: 14px;
    }

    .active-menu {
        font-weight: bolder;
        color: #d47fa6 !important;
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
                    <h6 class="mb-2 font-weight-bold">{{$service->name}}
                    </h6>

                    <div class="row">
                        <div class="col-md-12">
                            <p>{{$service->description}}</p>
                        </div>
                    </div>

                </div>
                <div class="p-4 bg-white rounded shadow-sm mb-3">
                    <h5 class="mb-4 font-weight-bold text-center">Add Service
                    </h5>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('provider.store_service')}}" method="POST">
                                @csrf
                                <input type="hidden" name="service_id" value="{{$service->id}}">
                                <div class="form-group">
                                    <label for="">
                                        Price (USD)
                                    </label>
                                    <input type="number" class="form-control" placeholder="Price (USD)" name="price">
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
