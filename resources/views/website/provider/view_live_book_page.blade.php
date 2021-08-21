
@extends('layouts.website')


@section('content')
    <div class="main-page second py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    @include('parts.provider_sidebar')
                </div>
                <div class="col-lg-8 right">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary" onclick="window.history.back()"> <i class="fa fa-arrow-alt-circle-left"></i> Back </button>

                        </div>
                    </div>
                    <div class="p-4 bg-white rounded shadow-sm mb-3">
                        <h5 class="mb-4 font-weight-bold text-center">{{$liveBookPage->liveBook->name}}
                        </h5>
                        <div class="row ">
                            <div class="col-md-12 " style="overflow: scroll;">
                                {!! html_entity_decode($liveBookPage->content) !!}
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
