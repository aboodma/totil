<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Gurdeep singh osahan">
    <meta name="author" content="Gurdeep singh osahan">
    <title>{{__('website_title')}} @yield('title')</title>
    <link rel="icon" type="image/png" href="images/favicon.ico">
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="{{asset('vendor/icons/css/materialdesignicons.min.css')}}" media="all" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/slick-master/slick/slick.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/lightgallery-master/dist/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/select2/css/select2-bootstrap.css')}}"/>
    <link href="{{asset('vendor/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    @yield('style')

    <style>
        .readed {
            background-color: silver;
        }
        .no-fo:focus {
            box-shadow: none;
        }
        .mobile > li > a {
            color: white;
        }

    </style>
</head>
<body>
<div class="pos-f-t">
    <div class="collapse d-lg-none " id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
            <ul class="navbar-nav mobile">
                @guest
                    <li class="nav-item pt-1 pb-1 ">
                        <a
                            id="navbarDropdownAlerts" href="{{route('login')}}"
                            role="button">
                            {{__('Login')}}
                        </a>

                    </li>
                    <li class="nav-item pt-1 pb-1 ">
                        <a
                            id="navbarDropdownAlerts" href="{{route('register')}}"
                            role="button">
                            {{__('Sign Up')}}
                        </a>

                    </li>
                    <li class="nav-item pt-1 pb-1 ">
                        <a
                            href="{{route('be_our_partner')}}" role="button">
                            {{__('Be Our Partner')}}
                        </a>

                    </li>
                @endguest
                <li class="nav-item pt-1 pb-1 ">
                    <a
                        id="navbarDropdownAlerts"
                        href="https://store.totil.net"
                        role="button">
                        {{__('Our Book Store')}}
                    </a>

                </li>
                <li class="nav-item pt-1 pb-1 ">
                    <a
                        id="navbarDropdownAlerts"
                        href="{{route('timeline')}}"
                        role="button">
                        {{__('Timeline')}}
                    </a>

                </li>
                @auth
                    <li class="nav-item pt-1 pb-1 ">
                        <a
                            id="navbarDropdownAlerts"
                            href="@if(auth()->user()->user_type == 1){{route('provider.dashboard')}} @elseif(auth()->user()->user_type == 0){{route('customer_dashboard')}} @else {{route('admin.home')}}  @endif"
                            role="button">
                            {{__('Profile')}}
                        </a>

                    </li>
                    <li class="nav-item pt-1 pb-1 ">
                        <a
                            data-toggle="modal" data-target="#createPostModel"
                            href="#"
                            role="button">
                            {{__('Create Post')}}
                        </a>

                    </li>
                    <li class="nav-item pt-1 pb-1 ">
                        <a class=""
                           id="navbarDropdownAlerts" href="{{ route('logout') }}" role="button"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                           aria-expanded="false">
                            Logout
                        </a>

                    </li>
                @endauth
            </ul>
        </div>
    </div>
</div>
    <nav class="navbar navbar-expand-lg navbar-light topbar  shadow-sm bg-white osahan-nav-top px-1  ">
        <div class="container">

            <a class="btn btn-icon btn-transparent-dark dropdown  no-arrow d-lg-none  " style="background: #f1f2f500"
               id="navbarDropdownMessages"
               href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                <i class="fas fa-globe-europe " style="font-size: 1.2rem;color: #04808b;"></i>
            </a>
            <div style="min-width: 9.75rem;"
                 class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                 aria-labelledby="navbarDropdownMessages">
                @foreach(App\Language::all() as $language)
                    <a class="dropdown-item dropdown-notifications-item p-2"
                       href="{{route('ChangeLocale',$language->locale)}}">
                        <img style="max-width: 1.5rem;max-height: 1.5rem;" class="dropdown-notifications-item-img"
                             src="{{$language->flag}}">
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-text">{{$language->name}}</div>
                        </div>
                    </a>
                @endforeach
            </div>

            <a class="navbar-brand d-none d-lg-block" href="{{route('welcome')}}">
                <img src="{{asset('images/logo.png')}}" style="height: 30px;" alt=""></a>
            <a class="navbar-brand d-lg-none  m-auto  pb-3" href="{{route('welcome')}}">
                <img style="height: 30px;" src="{{asset('images/logo.png')}}" alt=""></a>

            <form action="{{route('search')}}" method="GET"
                  class="d-none d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text"
                           style="/*! border-top-left-radius:20px; *//*! border-bottom-left-radius:20px; */padding:21px;border-radius: 20px;padding-right: 6.5rem;"
                           class="form-control bg-white small" name="q" placeholder="{{__('Find Services...')}}"
                           aria-label="Search"
                           aria-describedby="basic-addon2">

                    <button class="btn btn-dark"
                            style="/*! border-top-right-radius:20px; *//*! border-bottom-right-radius:20px; */position: absolute;right: 0px;/*! top: 0px; *//*! bottom: 0px; */border-radius: 20px;margin: 5px;background-color: #04808b;border-color: #04808b;"
                            type="submit">
                        <i class="fa fa-search fa-sm"></i>
                    </button>

                </div>
            </form>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav align-items-center ml-auto d-none d-lg-flex">
                <li class="nav-item dropdown no-arrow no-caret mr-2 dropdown-notifications d-sm-none">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle p-1" href="#" id="searchDropdown"
                       role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-search fa-fw"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right p-3 shadow-sm animated--grow-in"
                         aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                       placeholder="{{__('Find Services...')}}" aria-label="Search"
                                       aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item dropdown no-arrow no-caret mr-2 ">
                    <a class=" p-1" style="word-break: keep-all;white-space: nowrap;"
                       id="navbarDropdownAlerts"
                       href="{{route('timeline')}}"
                       role="button">
                        {{__('Timeline')}}
                    </a>

                </li>
                <li class="nav-item dropdown no-arrow no-caret mr-2 ">
                    <a class=" p-1" style="word-break: keep-all;white-space: nowrap;"
                       id="navbarDropdownAlerts"
                       href="https://store.totil.net"
                       role="button">
                        {{__('Our Book Store')}}
                    </a>

                </li>
                @auth
                    <li class="nav-item dropdown no-arrow no-caret mr-2 ">
                        <a class=" p-1" style="word-break: keep-all;white-space: nowrap;"
                           id="navbarDropdownAlerts"
                           href="@if(auth()->user()->user_type == 1){{route('provider.dashboard')}} @elseif(auth()->user()->user_type == 0){{route('customer_dashboard')}} @else {{route('admin.home')}}  @endif"
                           role="button">
                            {{__('Profile')}}
                        </a>

                    </li>
                    <li class="nav-item dropdown no-arrow no-caret mr-2 ">
                        <a class=" p-1" style="word-break: keep-all;white-space: nowrap;"
                           data-toggle="modal" data-target="#createPostModel"
                           href="#"
                           role="button">
                            {{__('Create Post')}}
                        </a>

                    </li>
                    <li class="nav-item dropdown no-arrow no-caret mr-1 dropdown-notifications">
                        <a class="btn btn-icon btn-transparent-dark dropdown-toggle p-1"
                           style="word-break: keep-all;white-space: nowrap;" style="background: #f1f2f500"
                           id="navbarDropdownAlerts" href="javascript:void(0);" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-bell">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg>
                            @if( auth()->user()->notifications->where('is_read',0)->count() != 0)
                                <i style="font-size: smaller;color:#04808b !important"
                                   class="fa fa-circle text-success"></i>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow  "
                             aria-labelledby="navbarDropdownAlerts">


                            @foreach(auth()->user()->notifications->sortBy('created_at') as $notification)
                                <a @if(!$notification->is_read) onclick="MarkRead({{$notification->id}})" @endif
                                class="dropdown-item dropdown-notifications-item @if($notification->is_read) readed @endif"
                                   @if($notification->type == 0 && auth()->user()->user_type == 1)
                                   href="{{route('provider.orders',"onGoing")}}"
                                   @elseif($notification->type == 0 && auth()->user()->user_type == 0)
                                   href="{{route('customer.orders')}}"
                                   @elseif($notification->type == 1 && auth()->user()->user_type == 1)
                                   href="{{route('provider.orders',"history")}}"
                                   @elseif($notification->type == 0 && auth()->user()->user_type == 0)
                                   href="{{route('customer.orders')}}"

                                    @endif>
                                    <div class="dropdown-notifications-item-icon bg-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-user-plus">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="8.5" cy="7" r="4"></circle>
                                            <line x1="20" y1="8" x2="20" y2="14"></line>
                                            <line x1="23" y1="11" x2="17" y2="11"></line>
                                        </svg>
                                    </div>
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-details">
                                            {{$notification->created_at->diffForHumans()}}</div>
                                        <div
                                            class="dropdown-notifications-item-content-text">{{$notification->msg}}</div>
                                    </div>
                                </a>
                            @endforeach
                            <a class="dropdown-item dropdown-notifications-footer"
                               href="#">{{__('View All Alerts')}}</a>
                        </div>

                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <li class="nav-item dropdown no-arrow no-caret  dropdown-notifications">
                        <button class="btn btn-icon btn-transparent-dark dropdown-toggle p-1"
                                style="background: #f1f2f500"
                                id="navbarDropdownAlerts" href="{{ route('logout') }}" role="button"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-log-out">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                        </button>

                    </li>
                @endauth
                @guest
                    <li class="nav-item dropdown no-arrow no-caret mr-2 ">
                        <a class=" p-1" style="word-break: keep-all;white-space: nowrap;"
                           href="{{route('be_our_partner')}}" role="button">
                            {{__('Be Our Partner')}}
                        </a>

                    </li>
                    <li class="nav-item dropdown no-arrow no-caret mr-2 ">
                        <a class="btn btn-outline-danger pink-btn p-1" style="word-break: keep-all;white-space: nowrap;"
                           id="navbarDropdownAlerts" href="{{route('login')}}"
                           role="button">
                            {{__('Login')}}
                        </a>

                    </li>
                    <li class="nav-item dropdown no-arrow no-caret mr-2 ">
                        <a class="btn btn-outline-secondary sec-btn p-1"
                           style="word-break: keep-all;white-space: nowrap;"
                           id="navbarDropdownAlerts" href="{{route('register')}}"
                           role="button">
                            {{__('Sign Up')}}
                        </a>

                    </li>
                @endguest
                <li class="nav-item dropdown no-arrow no-caret  dropdown-notifications">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle  " style="background: #f1f2f500"
                       id="navbarDropdownMessages"
                       href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <i class="fas fa-globe-europe " style="font-size: 1.2rem;color: #04808b;"></i>
                    </a>
                    <div style="min-width: 9.75rem;"
                         class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                         aria-labelledby="navbarDropdownMessages">
                        @foreach(App\Language::all() as $language)
                            <a class="dropdown-item dropdown-notifications-item p-2"
                               href="{{route('ChangeLocale',$language->locale)}}">
                                <img style="max-width: 1.5rem;max-height: 1.5rem;"
                                     class="dropdown-notifications-item-img"
                                     src="{{$language->flag}}">
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-text">{{$language->name}}</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>
    </nav>
@yield('content')
<!-- Modal -->
    <div class="modal fade" id="createPostModel" tabindex="-1" role="dialog" aria-labelledby="createPostModel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPostModel">Create Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('provider.create_post')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body ">
                        <div class="form-group p-0 m-0">
                            <textarea name="body" id="post_body" style="resize: none; border: none;"
                                      placeholder="Write What you want to do" class="form-control p-0 m-0 no-fo" id=""
                                      cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Text Color</label>
                            <input type="color" name="color" id="color" class="form-control form-control-color">
                        </div>
                        <div class="form-group">
                            <label for="">Background Color</label>
                            <select name="background" class="form-control">
                                <option class="bg-white" value="bg-white">white</option>
                                <option class="bg-success" value="bg-success">success</option>
                                <option class="bg-danger" value="bg-danger">danger</option>
                                <option class="bg-warning" value="bg-warning">warning</option>
                                <option class="bg-info" value="bg-info">info</option>
                                <option class="bg-light" value="bg-light">light</option>
                                <option class="bg-dark" value="bg-dark">dark</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Add File</label>
                            <input type="file" class="form-control" name="file" accept="video/*|image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="bg-white">
        <div class="container">
            <hr>
            <div class="d-flex justify-content-evenly">
                <div class="footer-list">
                    <div class="logo ml-5">
                        <a href="{{route('welcome')}}">
                            <img style="width: 10rem" src="{{asset('images/logo.png')}}">
                        </a>
                    </div>
                </div>
                <div class="footer-list">

                    <ul class="list">
                        <li><a href="#">{{__('How we work')}} </a></li>
                        <li><a href="#">{{__('About Us')}}</a></li>
                        <li><a href="#">{{__('Contact Us')}}</a></li>
                    </ul>
                </div>
                <div class="footer-list">

                    <ul class="list">
                        <li><a href="#">{{__('FAQ')}}</a></li>
                        <li><a href="#">{{__('Privacy Policy')}}</a></li>
                        <li><a href="#">{{__('Terms & Conditions')}}</a></li>

                    </ul>
                </div>

            </div>
            <div class="copyright">
                <p>{{__('?? Copyright 2022 Totil. All Rights Reserved')}}
                </p>
                <ul class="social">
                    <li>
                        <a href="#">
                            <i class="fab fa-facebook" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="{{asset('js/jqBootstrapValidation.js')}}" type="3ebbb932e316a3ee2377425e-text/javascript"></script>
    <script src="{{asset('js/contact_me.js')}}" type="3ebbb932e316a3ee2377425e-text/javascript"></script>
    <script src="{{asset('vendor/slick-master/slick/slick.js')}}" type="3ebbb932e316a3ee2377425e-text/javascript"
            charset="utf-8">
    </script>
    <script src="{{asset('vendor/lightgallery-master/dist/js/lightgallery-all.min.js')}}"
            type="3ebbb932e316a3ee2377425e-text/javascript"></script>
    <script src="{{asset('vendor/select2/js/select2.min.js')}}" type="3ebbb932e316a3ee2377425e-text/javascript">
    </script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    @yield('script')
    <script src="{{asset('js/custom.js')}}" type="3ebbb932e316a3ee2377425e-text/javascript"></script>
    <script>
        $(document).ready(function () {
            //change the integers below to match the height of your upper div, which I called
            //banner.  Just add a 1 to the last number.  console.log($(window).scrollTop())
            //to figure out what the scroll position is when exactly you want to fix the nav
            //bar or div or whatever.  I stuck in the console.log for you.  Just remove when
            //you know the position.
            $(window).scroll(function () {

                // console.log($(window).scrollTop());

                if ($(window).scrollTop() > 200) {
                    $('.navbar').addClass('fixed-top');
                }

                if ($(window).scrollTop() < 201) {
                    $('.navbar').removeClass('fixed-top');
                }
            });
        });

        function MarkRead(id) {
            $.ajax({
                url: "{{route('notify_read')}}",
                type: "POST",
                data: {
                    "_token": "{{csrf_token()}}",
                    "id": id
                },

            })
        }

        function manageFavorit(id) {
            if ($("#heart_" + id).hasClass("favorit")) {
                $("#heart_" + id).removeClass("favorit");
                removeFromFavorit(id);
            } else {
                $("#heart_" + id).addClass("favorit");
                addToFavorit(id);

            }
        }

        function addToFavorit(id) {

            $.ajax({
                url: "{{route('customer.addToFavorit')}}",
                type: "POST",
                data: {
                    "_token": "{{csrf_token()}}",
                    "id": id
                },
                success: function () {
                    $("#heart_" + id).effect("puff", function () {
                        setTimeout(function () {
                            $("#heart_" + id).removeAttr("style").hide().fadeIn();
                            $("#heart_" + id).css('color', "#04808b");

                        }, 100);
                        return false;
                    });
                }
            })

        }

        function removeFromFavorit(id) {

            $.ajax({
                url: "{{route('customer.removeFromFavorit')}}",
                type: "POST",
                data: {
                    "_token": "{{csrf_token()}}",
                    "id": id
                },
                success: function () {
                    $("#heart_" + id).effect("puff", function () {
                        setTimeout(function () {
                            $("#heart_" + id).removeAttr("style").hide().fadeIn();
                            $("#heart_" + id).css('color', "white");

                        }, 100);
                        return false;
                    });
                }
            })

        }

        $("#color").on("change", function () {
            var color = $(this).val();
            $("#post_body").css('color', color);
        });

        function Like(id) {
            $.ajax({
                    url: "{{route('like')}}",
                    type: "POST",
                    data: {"_token": "{{csrf_token()}}", "post_id": id},
                    success: function (data) {
                        console.log(data);
                        $("#post_" + id + "_15987536912301023487954648").addClass('liked');
                    }
                }
            )
        }

        function UnLike(id) {
            $.ajax({
                    url: "{{route('unlike')}}",
                    type: "POST",
                    data: {"_token": "{{csrf_token()}}", "post_id": id},
                    success: function (data) {
                        console.log(data);
                        $("#post_" + id + "_15987536912301023487954648").removeClass('liked');
                    }
                }
            )
        }

        function toggleLike(id) {
            if ($("#post_" + id + "_15987536912301023487954648").hasClass("liked")) {
                UnLike(id);
            } else {
                Like(id);
            }
        }

        function submiter(id) {
            var x = event.keyCode;
            if (x == 13) {
                var body = $("#body_" + id + "_54649861321984654").val();
                $("#body_" + id + "_54649861321984654").prop("disabled", true);
                $.ajax({

                    url: "{{route('comment')}}",
                    type: "POST",
                    data: {"_token": "{{csrf_token()}}", "post_id": id, "body": body},
                    success: function (data) {
                        $("#body_" + id + "_54649861321984654").prop("disabled", false);
                        $("#body_" + id + "_54649861321984654").val("");
                        var comment = "<div class='col-md-12'> <p> " + body + " </p> </div>";
                        $("#Commenter_1455_" + id).append(comment);

                    }
                });
            }
        }
    </script>
</body>
</html>
