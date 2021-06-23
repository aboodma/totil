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
        color: #d47fa6;
        border-color: #d47fa6;
        border-radius: 20px;
    }

    .pink-btn:hover {
        color: #fff !important;
        background-color: #d47fa6 !important;
        border-color: #d47fa6 !important;
    }

    .btn-big-pink {
        background-color: #d47fa6 !important;
        border-color: #d47fa6 !important;

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
        <div class="col-md-12">
         
    
                <div class="alert alert-danger" id="errors-warper" style="display: none">
                    <p id="errors">
                       
                    </p>
                </div>
           
        </div>
        <div class="col-md-8">
            <legend>Be Our Partner</legend>
            <form method="POST" action="{{ route('provider_request') }}" id="be_our_partner" enctype="multipart/form-data">
                @csrf
               
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control rd-in @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control rd-in @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control rd-in @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control rd-in" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label text-md-right"> {{__('Select Your Job Title')}}</label>
                    <div class="col-md-6">
                        <select name="provider_type_id" class="form-control" id="">
                            <option value="">{{__('Please Select')}} </option>
                            @foreach (\App\ProviderType::all() as $type)

                            <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                        @error('provider_type_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label text-md-right"> {{__('Select Your Country')}}</label>
                    <div class="col-md-6">
                        <select name="country_id" class="form-control" id="">
                            <option value="">Please Select </option>
                            @foreach (\App\Country::all() as $country)

                            <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label text-md-right"> {{__('About You')}} </label>
                    <div class="col-md-6">
                        <textarea name="about_me" class="form-control" id="" cols="30" rows="5"></textarea>
                        @error('about_me')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{__('Profile Video')}}</label>

                    <div class="col-md-6">
                        <input type="file" name="video" class="form-control rd-in" accept="video/*" id="">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{__('Profile Picture')}}</label>

                <div class="col-md-6">
                    <input type="file" name="avatar" class="form-control rd-in" accept="image/*" id="">
            </div>
        </div>
        <div class="form-group row ">
            <div class="col-md-6 offset-md-4">
                <div class="progress" id="progress" >
                    <div class="progress-bar progress-bar-striped progress-bar-animated" id="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
                  </div>
                  
            </div>
        </div>
        
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" id="btn_submit" class="btn btn-success rd-in btn-block">
                            {{ __('Send Request') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')

<script>
    $(function() {
         $(document).ready(function()
         {

            var progress_bar = $(".progress-bar");
 
      $('form').ajaxForm({
        beforeSend: function() {
            var percentVal = '0%';
            $("#btn_submit").attr('disabled',true);
            progress_bar.width(percentVal)
            progress_bar.html(percentVal);
            progress_bar.css('width',percentVal)
            progress_bar.attr('aria-valuenow',percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';

            progress_bar.css('width',percentVal)
            progress_bar.html(percentVal);
            progress_bar.attr('aria-valuenow',percentVal);
        },
        complete: function(xhr) {
            $("#btn_submit").attr('disabled',false);
            console.log(xhr.responseText);
            
        },
        success : function(data){
            // console.log(data);
        window.location.replace(data)
        },
        error:function(xhr){
            const obj = JSON.parse(xhr.responseText);
            $("#errors-warper").show();
            $("#errors").html(obj.message);
            // for (let index = 0; index < obj.errors; index++) {
            //     console.log(obj.errors[index]);
                
            // }
        }
       
        
      });
   }); 
 });
</script>
@endsection
