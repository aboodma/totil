@extends('layouts.website')
@section('style')

@endsection
@section('content')


<div class="services-wrapper bg-white py-5">
    <div class="container">
        <div class="row main-slider">


            <div class="col-md-12">
                <div class="service">
                 
                        
                    <img class="d-block d-sm-block d-xs-block d-lg-none " src="{{asset(App\HomePageBanner::where('locale',App::getLocale())->first()->small_image)}}">
                    <img class="d-none d-sm-block " src="{{asset(App\HomePageBanner::where('locale',App::getLocale())->first()->image)}}">
                    <h3 class="text-center d-block d-sm-block d-xs-block d-lg-none banner-text"
                        style="font-size: 1.4rem !important;">
                        {{App\HomePageBanner::where('locale',App::getLocale())->first()->text_1}} 
                        <br> {{App\HomePageBanner::where('locale',App::getLocale())->first()->text_2}} <br>
                        @guest
                        <a href="{{route('register')}}" class="btn btn-lg btn-light rd-in mt-3 primary-color-rev"> {{App\HomePageBanner::where('locale',App::getLocale())->first()->button_text}} </a>
                        @endguest
                    </h3>
                    <h3 class="text-center d-none d-sm-block banner-text">{{App\HomePageBanner::where('locale',App::getLocale())->first()->text_1}}<br>{{App\HomePageBanner::where('locale',App::getLocale())->first()->text_2}}<br>
                        @guest
                        <a href="{{route('register')}}" class="btn btn-lg btn-light rd-in mt-3 primary-color-rev"> {{App\HomePageBanner::where('locale',App::getLocale())->first()->button_text}} </a>
                        @endguest
                    </h3>
           

                </div>
            </div>

        </div>
    </div>
</div>


<div class="services-wrapper bg-white py-3">
    <div class="container">
        <p style="font-weight: 800;font-size:1.3rem; color:#241332" class="pb-0 mb-1">{{__('Categories')}}
            <a href="{{route('categories')}}" style="color:#04808B; font-weight:800" class="float-right"> <small
                    style="font-size: 13px ; font-weight:700">{{__('See all')}} </small></a>
        </p>
        <div class="row service-slider">
            @foreach (App\ProviderType::all() as $providerType)
            <div class="col">
                <a href="{{route('FilterByType',$providerType->id)}}">
                    <div class="service">


                        <img width="100" src="{{asset($providerType->image)}}">
                        <h3 class="text-center">{{_ti($providerType->name)}}</h3>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>



<div class="freelance-projects bg-white py-3">
    <div class="container">
        <p style="font-weight: 800;font-size:1.3rem; color:#241332" class="pb-0 pt-3 mb-1">{{__('Featured')}}
            <a href="{{route('featured')}}" style="color:#04808B; font-weight:800" class="float-right"> <small
                    style="font-size: 13px ; font-weight:700">{{__('See all')}} </small></a>
        </p>
        <div class="row ">
            @foreach (\App\Provider::where('is_approved',true)->take(4)->get() as $provider)
            <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-6 col-6">
                <div class="freelancer">
                    <div>
                        <div class="top-right p-1 text-center">
                            @guest
                            <a href="{{route('login')}}">
                                <span class="fas fa-heart" id="heart_{{$provider->id}}"></span>
                            </a>
                            @endguest
                            @auth
                            <span class="fas fa-heart
                                      
                                            @if(auth()->user()->favorits->where('provider_id',$provider->id)->count() != 0) favorit @endif
                                            " @if(auth()->user()->favorits->where('provider_id',$provider->id)->count()
                                != 0)
                                style="color: rgb(212, 127, 166);" @endif id="heart_{{$provider->id}}"

                                onclick="manageFavorit({{$provider->id}})"
                                ></span>

                            @endauth
                        </div>
                        @if($provider->services()->exists())
                        <div class="bottom-left p-1">
                            <span>{{$provider->services->first()->price}} USD</span> <i class="fa fa-video-camera"></i>

                        </div>
                        @endif
                        <a href="{{route('provider_profile',$provider->id)}}">
                            <img src="{{asset($provider->user->avatar)}}">
                        </a>
                    </div>
                    <a href="{{route('provider_profile',$provider->id)}}">
                        <div class="freelancer-footer">

                            <h5 style="padding: 0px;">{{$provider->user->name}}
                                <span style="font-size: 12px">{{ucfirst(strtolower(_ti($provider->ProviderType->name)))}}
                                    <br>
                                    {{ucfirst(strtolower(_ti($provider->Country->name)))}}</span>
                            </h5>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="freelance-projects bg-white py-3">
    <div class="container">
        <div class="row">
            @foreach (App\HomePageProviderType::all() as $category)
                
            
            <div class="col-md-12">
                <p style="font-weight: 800;font-size:1.3rem; color:#241332" class="pb-0 mb-1">{{_ti($category->providerType->name)}}
                    <a href="{{route('FilterByType',$category->provider_type_id)}}" style="color:#04808B; font-weight:800" class="float-right">
                        <small style="font-size: 13px ; font-weight:700">{{__('See all')}} </small></a>
                </p>
                <div class="row ">
                    @foreach (\App\Provider::where('provider_type_id',$category->provider_type_id)->take(4)->get() as $provider)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-6">

                        <div class="freelancer">
                            <div>
                                <div class="top-right p-1 text-center">
                                    @guest
                                    <a href="{{route('login')}}">
                                        <span class="fas fa-heart" id="heart_{{$provider->id}}"></span>
                                    </a>
                                    @endguest
                                    @auth
                                    <span class="fas fa-heart
                                      
                                            @if(auth()->user()->favorits->where('provider_id',$provider->id)->count() != 0) favorit @endif
                                            " @if(auth()->user()->favorits->where('provider_id',$provider->id)->count()
                                        != 0)
                                        style="color: rgb(212, 127, 166);" @endif id="heart_{{$provider->id}}"

                                        onclick="manageFavorit({{$provider->id}})"
                                        ></span>

                                    @endauth

                                </div>
                                @if($provider->services()->exists())
                                <div class="bottom-left p-1">
                                    <span>{{$provider->services->first()->price}} USD</span> <i
                                        class="fa fa-video-camera"></i>

                                </div>
                                @endif
                                <a href="{{route('provider_profile',$provider->id)}}">
                                    <img src="{{asset($provider->user->avatar)}}">
                                </a>
                            </div>
                            <a href="{{route('provider_profile',$provider->id)}}">
                                <div class="freelancer-footer">

                                    <h5 style="padding: 0px;">{{$provider->user->name}}
                                        <span
                                            style="font-size: 12px">{{ucfirst(strtolower(_ti($provider->ProviderType->name)))}}
                                            <br>
                                            {{ucfirst(strtolower(_ti($provider->Country->name)))}}</span>
                                    </h5>
                                </div>
                            </a>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.service-slider').slick({
            infinite: true,
            slidesToShow: 6,
            slidesToScroll: 6,

            centerPadding: '60px',
            adaptiveHeight: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
            ]

        });


        // $('.main-slider').slick({
        //     infinite: true,
        //     slidesToShow: 1,
        //     slidesToScroll: 1,
        //     arrows: false,
        //     autoplay: true,
        //     autoplaySpeed: 2000,
        //     fade: true,
        // });
    })
    //   freelance-slider

</script>
@endsection
