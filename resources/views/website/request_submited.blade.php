@extends('layouts.website')
@section('style')
<style>
    .bak {
        background: #2a4d6c69;
        width: 100%;
        background-size: cover;
        height: 100%;
        position: absolute;
    }

    .pink-btn {
        color: #04808B;
        border-color: #04808B;
        border-radius: 20px;
    }

    .pink-btn:hover {
        color: #fff !important;
        background-color: #04808B !important;
        border-color: #04808B !important;
    }

    .btn-big-pink {
        background-color: #04808B !important;
        border-color: #04808B !important;

    }


    .sec-btn {
        border-radius: 20px;
    }
    .rd-in {
        border-radius: 20px;
    }

</style>
@endsection
@section('content')
<div class="services-wrapper bg-white py-5">


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <legend>{{__('Request Submited')}} </legend>
                <p>{{__('Thank you')}} {{$user->name}} <br>
               {{__(' Your Request Is in progrress Our Support Will Contact with you To confirm and Aprrove Your Account')}}</p>
                <a href="{{route('welcome')}}" class="btn btn-success btn-block btn-lg"> {{__('Back To Home Page')}}</a>
            </div>  
    </div>
</div>
</div>
@endsection
