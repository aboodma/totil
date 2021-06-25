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
                 
                <div class="p-4 bg-white rounded shadow-sm mb-3">
                    <h5 class="mb-4 font-weight-bold text-center">{{__('Create Book')}}
                    </h5>
                    <div class="row ">
                        <div class="col-md-12  ">
                           <form action="{{route('provider.books.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                               <div class="form-group">
                                   <label for="">Book Title</label>
                                   <input type="text" class="form-control" name="title">
                               </div>
                               <div class="form-group">
                                   <label for="">Book Description</label>
                                   <textarea name="description" class="form-control" cols="30" rows="5"></textarea>
                               </div>
                               <div class="row">
                                   <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Publisher</label>
                                        <input type="text" name="publisher" class="form-control">
                                    </div>
                                    
                                   </div>
                                   <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Release Year</label>
                                        <input type="number" name="release_year" class="form-control">
                                    </div>
                                   </div>
                                   <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Pages Count</label>
                                        <input type="number" name="pages_count" class="form-control">
                                    </div>
                                   </div>
                               </div>
                               <div class="form-group">
                                <label for="">Book Cover</label>
                                <input type="file" name="cover_path" id="" class="form-control">
                               </div>
                               <div class="form-group">
                                <label for="">Audio Simple</label>
                                <input type="file" name="audio_simple" id="" class="form-control">
                               </div>
                               <div class="form-group">
                                <label for="">Video Simple</label>
                                <input type="file" name="video_simple" id="" class="form-control">
                               </div>
                               <div class="form-group">
                                   <button class="form-control btn btn-success" type="submit">Create</button>
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
