<div class="row">
    <div class="col-lg-12 pb-3">
        <div class="bg-white  shadow-sm pr-3 pl-3 pt-2 pb-2  " style="background-color: #241332 !important">
            <div class="dropdown-menu-show clearfix ">
                <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                    aria-controls="collapseExample" style="font-weight: 600
         " class=" text-white">
                    <p class="float-left m-0" style="font-size: larger"><b> <i class="fa fa-bars"></i> {{__('Menu')}}</b> </p>
                    
                </a>

            </div>
        </div>
        <div id="collapseExample" class="bg-white rounded shadow-sm sidebar-fix collapse  pb-2" >

            <div class="dropdown-menu-show">
                <a class="dropdown-item py-2 @if (Route::is('provider.dashboard')) active   @endif"
                    href="{{route('provider.dashboard')}} ">
                    {{__('Profile')}}
                </a>
                <a class="dropdown-item py-2" @if (auth()->user()->provider->is_approved)
                    href="{{route('provider.profile')}}"
                    @endif>
                    {{__('Profile Settings')}}
                </a>

                <a class="dropdown-item py-2" href="{{route('provider.payment_settings')}}">
                    {{__('Payment Settings')}}
                </a>
                <a class="dropdown-item py-2 @if (Route::is('provider.services')) active   @endif"
                    @if(auth()->user()->provider->is_approved)
                    href="{{route('provider.orders',"onGoing")}}"
                    @endif>
                    {{__('On Going Orders')}}
                </a>
                <a class="dropdown-item py-2 @if (Route::is('provider.services')) active   @endif"
                    @if(auth()->user()->provider->is_approved)
                    href="{{route('provider.orders',"history")}}"
                    @endif>
                    {{__('Order History')}}
                </a>
                <a class="dropdown-item py-2" @if(auth()->user()->provider->is_approved)
                    href="{{route('provider.services')}}"
                    @endif>
                    {{__('My Services')}}
                </a>
                <a class="dropdown-item py-2" href="{{route('provider.wallet')}}">
                    {{__('My Wallet')}}
                </a>
                <a class="dropdown-item py-2" href="{{route('provider.payouts')}}">
                    {{__('Payout Requests')}}
                </a>




                <a class="dropdown-item py-2 " href="edit-payment.html">
                    {{__('Log Out')}}
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="profile_info">
            <div class="seller-card">
                <div>
                   
                </div>
                <div><a href="#" class="ambassadors-badge">{{auth()->user()->provider->providerType->name}}</a></div>
                <div class="user-profile-info">
                    <div>
                        <div class="user-profile-image">
                            <label class="user-pict">
                                <img src="{{asset(auth()->user()->avatar)}}" class="img-fluid user-pict-img" alt="Askbootstrap">
                                <a href="#"
                                    class="user-badge-round user-badge-round-med locale-en-us top-rated-seller"></a></label>
                        </div>
                    </div>
                    <div class="user-profile-label">
                        <div class="username-line">
                            <a href="#" class="seller-link">{{auth()->user()->name}}</a>
                        </div>
                        <div class="oneliner-wrapper">
                            <small class="oneliner">{{auth()->user()->provider->providerType->name}}</small>
                            <div class="ratings-wrapper">
                                <p class="rating-text"><strong>5.0</strong> (1k+ reviews)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="buttons-wrapper  justify-content-around" style="display:block ">
                    <a href="{{route('provider_profile',auth()->user()->provider->id)}}" target="_blank" class="btn btn-success btn-contact-me js-contact-me js-open-popup-join">{{__('Show Profile')}}</a>
                   <a href="{{route('provider.profile')}}" class="btn btn-outline-secondary">{{__('Edit Profile')}}</a>
                </div>
                <div class="user-stats-desc">
                    <ul class="user-stats">
                        <li class="location">  {{__('From')}}<strong> {{ucfirst(strtolower(auth()->user()->provider->country->name))}}</strong></li>
                        <li class="member-since">{{__('Member since')}}<strong>{{\Carbon\Carbon::createFromTimeStamp(strtotime(auth()->user()->created_at))->diffForHumans()}}</strong></li>
                        <li class="response-time">{{__('Avg. Response Time')}}<strong>2 h</strong></li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

