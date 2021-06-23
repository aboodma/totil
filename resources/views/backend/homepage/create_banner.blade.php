@extends('layouts.backend')
@section('page_header','Service Create')
@section('page_toolbar')

@endsection
@section('content')

<div class="content flex-column-fluid" id="kt_content">
 
    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Create Banner</h3>
                
            </div>
            <!--begin::Form-->
            <form action="{{route('admin.homepage.banners.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-8">
                    </div>
                    
                   
                    <div class="form-group">
                        <label>Slug 1</label>
                        <textarea name="text1" class="form-control" id="" cols="30" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Slug 2</label>
                        <textarea name="text2" class="form-control" id="" cols="30" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Button Text</label>
                        <input type="text" class="form-control" name="button_text">
                    </div>
                    <div class="form-group">
                        <label for="">Image (1692*488)</label>
                        <input type="file" name="image" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Mobile Image (1366*768)</label>
                        <input type="file" name="image_small" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Language</label>
                        <select name="locale" class="form-control" id="">
                            @foreach ($languages as $language)
                            <option value="{{$language->locale}}" @if($language->is_default) selected @endif>{{$language->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    
                   
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
            <!--end::Form-->
        </div>
      
        
    </div>
  
</div>
<!--end::Content-->
@endsection
