@extends('layouts.backend')
@section('page_header','Users Create')
@section('page_toolbar')

@endsection
@section('content')

<div class="content flex-column-fluid" id="kt_content">
    @if($user_type == 2 || $user_type == 0)
    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Create Admin</h3>
                
            </div>
            <!--begin::Form-->
            <form action="{{route('admin.user_store',compact('user_type'))}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-8">
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name ">
                    </div>
                    <div class="form-group">
                        <label>Email address 
                        <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email">
                        <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                    </div>
                    <div class="form-group">
                        <label>Phone
                        <span class="text-danger">*</span></label>
                        <input type="tel" name="phone" class="form-control" placeholder="Enter phone">
                        <span class="form-text text-muted">We'll never share your phone with anyone else.</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password 
                        <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
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
    @elseif ($user_type == 1)
    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Create Provider</h3>
                
            </div>
            <!--begin::Form-->
            <form method="POST" action="{{route('admin.provider_store',$user_type)}}">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-8">
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name ">
                    </div>
                    <div class="form-group">
                        <label>Email address 
                        <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email">
                        <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password 
                        <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="">About Me</label>
                        <textarea name="about_me" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Country</label>
                        <select name="country_id" class="form-control" id="">
                            <option value="">Select Country</option>
                            @foreach (\App\Country::all() as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Provider Type</label>
                        <select name="provider_type" class="form-control" id="">
                            <option value="">Select Provider Type</option>
                            @foreach (\App\ProviderType::all() as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Is Approved </label>
                        <select name="is_approved" class="form-control" id="">
                            <option value="0">False</option>
                            <option value="1">True</option>

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
    @endif
</div>
<!--end::Content-->
@endsection
