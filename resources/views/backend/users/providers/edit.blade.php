@extends('layouts.backend')
@section('page_header','Provider Edit')
@section('style')

<link rel="stylesheet" href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}">
@endsection
@section('page_toolbar')


@endsection
@section('content')

<div class="content flex-column-fluid" id="kt_content">
    @if($errors->all())
    <div class="alert alert-danger" id="errors-warper">
        @foreach ($errors->all() as $error)
        {{ $error }}<br/>
    @endforeach
    </div>
    @endif
    <div class="tab-pane show px-7 active" id="kt_user_edit_tab_1" role="tabpanel">
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-7 my-2">
                <!--begin::Row-->
                <div class="row">
                    <label class="col-3"></label>
                    <div class="col-9">
                        <h6 class="text-dark font-weight-bold mb-10">Provider Info:</h6>
                    </div>
                </div>
                <form action="{{route('admin.users.providers_update',$user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <!--end::Row-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">Avatar</label>
                    <div class="col-9">
                        <div class="image-input image-input-empty image-input-outline" id="kt_user_edit_avatar" style="background-image: url({{asset($user->avatar)}})">
                            <div class="image-input-wrapper"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                                <input type="hidden" name="profile_avatar_remove">
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">Full Name</label>
                    <div class="col-9">
                        <input class="form-control form-control-lg form-control-solid" name="name" type="text" value="{{$user->name}}" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                    </div>
                </div>
                <!--end::Group-->
               
             
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">Contact Phone</label>
                    <div class="col-9">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-phone"></i>
                                </span>
                            </div>
                            <input type="text" name="phone" class="form-control form-control-lg form-control-solid" value="{{$user->phone}}" placeholder="Phone">
                        </div>
                    
                    </div>
                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">Country</label>
                    <div class="col-9">
                        <select name="country_id" class="form-control form-control-lg form-control-solid" id="">
                            <option value="">Select Country</option>
                            @foreach (\App\Country::all() as $country)
                             @if ($user->provider->country_id == $country->id)
                            <option selected value="{{$country->id}}">{{$country->name}}</option>
                            @endif 
                                <option value="{{$country->id}}" >{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <!--end::Group-->
                 <!--begin::Group-->
                 <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">Provider Type</label>
                    <div class="col-9">
                        <select name="provider_type" class="form-control form-control-lg form-control-solid" id="">
                            <option value="">Select Provider Type</option>
                            @foreach (\App\ProviderType::all() as $type)
                            @if ($user->provider->provider_type_id == $type->id )
                            <option selected value="{{$type->id}}">{{$type->name}}</option>
                                
                            @else
                            <option value="{{$type->id}}">{{$type->name}}</option>
                                
                            @endif
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">Is Approved </label>
                   <div class="col-9">
                    <select name="is_approved" class="form-control form-control-lg form-control-solid" id="">
                        <option @if(!$user->provider->is_approved) selected @endif value="0">False</option>
                        <option @if($user->provider->is_approved) selected @endif value="1">True</option>

                    </select>
                   </div>
                </div>
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">About Me</label>
                    <div class="col-9">
                        <textarea name="about_me" class="form-control form-control-lg form-control-solid" id="" cols="30" rows="10">{{$user->provider->about_me}}</textarea>
                    </div>
                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">Facebook</label>
                    <div class="col-9">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-facebook"></i>
                                </span>
                            </div>
                            <input type="text" name="fb" class="form-control form-control-lg form-control-solid" value="{{$user->phone}}" placeholder="Facebook">
                        </div>
                    </div>
                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">Instagram</label>
                    <div class="col-9">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-instagram"></i>
                                </span>
                            </div>
                            <input type="text" name="ig" class="form-control form-control-lg form-control-solid" value="{{$user->phone}}" placeholder="Instagram">
                        </div>
                    </div>
                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">Twitter</label>
                    <div class="col-9">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-twitter"></i>
                                </span>
                            </div>
                            <input type="text" name="tweet" class="form-control form-control-lg form-control-solid" value="{{$user->phone}}" placeholder="Twitter">
                        </div>
                    </div>
                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">Youtube</label>
                    <div class="col-9">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-youtube"></i>
                                </span>
                            </div>
                            <input type="text" name="youtube" class="form-control form-control-lg form-control-solid" value="{{$user->phone}}" placeholder="Youtube">
                        </div>
                    </div>
                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">Tiktok</label>
                    <div class="col-9">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-tiktok"></i>
                                </span>
                            </div>
                            <input type="text" name="tiktok" class="form-control form-control-lg form-control-solid" value="{{$user->phone}}" placeholder="Tiktok">
                        </div>
                    </div>
                </div>
                <!--end::Group-->
                <!--begin::Group-->
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">Snapchat</label>
                    <div class="col-9">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-snapchat"></i>
                                </span>
                            </div>
                            <input type="text" name="snap" class="form-control form-control-lg form-control-solid" value="{{$user->phone}}" placeholder="Snapchat">
                        </div>
                    </div>
                </div>
                <!--end::Group-->
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left"></label>
                   <div class="col-9">
                    <button type="submit" class="form-control btn btn-light-success form-control-lg form-control-solid">Save</button>
                   </div>
                </div>
                <!--end::Group-->
            </form>
            </div>
        </div>
        <!--end::Row-->
    </div>
    
</div>
<!--end::Content-->
@endsection


@section('script')


@endsection