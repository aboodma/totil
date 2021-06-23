@extends('layouts.backend')
@section('page_header','Customers Edit')
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
    <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
        <form class="form" method="POST" action="{{route('admin.users.customers_update',$user->id)}}">
            @csrf
            <!--begin::Heading-->
            <div class="row">
                <div class="col-lg-9 col-xl-6 offset-xl-3">
                    <h3 class="font-size-h6 mb-5">Customer Info:</h3>
                </div>
            </div>
            <!--end::Heading-->
            
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 text-right col-form-label">Customer Name</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" name="name" type="text" value="{{$user->name}}" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 text-right col-form-label">Customer Email</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" name="email" type="email" value="{{$user->email}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 text-right col-form-label">Password</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" name="password" type="password" value="">
   
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 text-right col-form-label"></label>
              
                <div class="col-lg-9 col-xl-6">
                    <button type="submit" class="form-control form-control-lg  btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3"> Save </button>
                   
                </div>
            </div>
        </form>
    </div>
    
</div>
<!--end::Content-->
@endsection


@section('script')


@endsection