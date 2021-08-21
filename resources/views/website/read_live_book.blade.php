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

        .sec-btn {
            border-radius: 20px;
        }

        .flipbook .page {
            /*height: 100%;*/
            width: 100%;
        }.flipbook .page img {
             max-width: 100%;
             height: 100%;
         }

        #flipbook .page-wrapper {
            -webkit-perspective: 2000px;
            -moz-perspective: 2000px;
            -ms-perspective: 2000px;
            -o-perspective: 2000px;
            perspective: 2000px;
        }

        #flipbook .hard {
            background: #ccc !important;
            color: #333;
            -webkit-box-shadow: inset 0 0 5px #666;
            -moz-box-shadow: inset 0 0 5px #666;
            -o-box-shadow: inset 0 0 5px #666;
            -ms-box-shadow: inset 0 0 5px #666;
            box-shadow: inset 0 0 5px #666;
            font-weight: bold;
        }

        #flipbook .odd {
            background: -webkit-gradient(linear, right top, left top, color-stop(0.95, #FFF), color-stop(1, #DADADA));
            background-image: -webkit-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
            background-image: -moz-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
            background-image: -ms-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
            background-image: -o-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
            background-image: linear-gradient(right, #FFF 95%, #C4C4C4 100%);
            -webkit-box-shadow: inset 0 0 5px #666;
            -moz-box-shadow: inset 0 0 5px #666;
            -o-box-shadow: inset 0 0 5px #666;
            -ms-box-shadow: inset 0 0 5px #666;
            box-shadow: inset 0 0 5px #666;
        }

        #flipbook .even {
            background: -webkit-gradient(linear, left top, right top, color-stop(0.95, #fff), color-stop(1, #dadada));
            background-image: -webkit-linear-gradient(left, #fff 95%, #dadada 100%);
            background-image: -moz-linear-gradient(left, #fff 95%, #dadada 100%);
            background-image: -ms-linear-gradient(left, #fff 95%, #dadada 100%);
            background-image: -o-linear-gradient(left, #fff 95%, #dadada 100%);
            background-image: linear-gradient(left, #fff 95%, #dadada 100%);
            -webkit-box-shadow: inset 0 0 5px #666;
            -moz-box-shadow: inset 0 0 5px #666;
            -o-box-shadow: inset 0 0 5px #666;
            -ms-box-shadow: inset 0 0 5px #666;
            box-shadow: inset 0 0 5px #666;
        }

        .slick-track {
            float: left;
        }

        .resp-sharing-button__link,
        .resp-sharing-button__icon {
            display: inline-block
        }

        .resp-sharing-button__link {
            text-decoration: none;
            color: #fff;
            margin: 0.2em
        }

        .resp-sharing-button {
            border-radius: 5px;
            transition: 25ms ease-out;
            padding: 0.5em 0.75em;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif
        }

        .resp-sharing-button__icon svg {
            width: 1em;
            height: 1em;
            margin-right: 0.4em;
            vertical-align: top
        }

        .resp-sharing-button--small svg {
            margin: 0;
            vertical-align: middle
        }

        /* Non solid icons get a stroke */
        .resp-sharing-button__icon {
            stroke: #fff;
            fill: none
        }

        /* Solid icons get a fill */
        .resp-sharing-button__icon--solid,
        .resp-sharing-button__icon--solidcircle {
            fill: #fff;
            stroke: none
        }

        .resp-sharing-button--twitter {
            background-color: #55acee
        }

        .resp-sharing-button--twitter:hover {
            background-color: #2795e9
        }

        .resp-sharing-button--pinterest {
            background-color: #bd081c
        }

        .resp-sharing-button--pinterest:hover {
            background-color: #8c0615
        }

        .resp-sharing-button--facebook {
            background-color: #3b5998
        }

        .resp-sharing-button--facebook:hover {
            background-color: #2d4373
        }

        .resp-sharing-button--tumblr {
            background-color: #35465C
        }

        .resp-sharing-button--tumblr:hover {
            background-color: #222d3c
        }

        .resp-sharing-button--reddit {
            background-color: #5f99cf
        }

        .resp-sharing-button--reddit:hover {
            background-color: #3a80c1
        }

        .resp-sharing-button--google {
            background-color: #dd4b39
        }

        .resp-sharing-button--google:hover {
            background-color: #c23321
        }

        .resp-sharing-button--linkedin {
            background-color: #0077b5
        }

        .resp-sharing-button--linkedin:hover {
            background-color: #046293
        }

        .resp-sharing-button--email {
            background-color: #777
        }

        .resp-sharing-button--email:hover {
            background-color: #5e5e5e
        }

        .resp-sharing-button--xing {
            background-color: #1a7576
        }

        .resp-sharing-button--xing:hover {
            background-color: #114c4c
        }

        .resp-sharing-button--whatsapp {
            background-color: #25D366
        }

        .resp-sharing-button--whatsapp:hover {
            background-color: #1da851
        }

        .resp-sharing-button--hackernews {
            background-color: #FF6600
        }

        .resp-sharing-button--hackernews:hover,
        .resp-sharing-button--hackernews:focus {
            background-color: #FB6200
        }

        .resp-sharing-button--vk {
            background-color: #507299
        }

        .resp-sharing-button--vk:hover {
            background-color: #43648c
        }

        .resp-sharing-button--facebook {
            background-color: #3b5998;
            border-color: #3b5998;
        }

        .resp-sharing-button--facebook:hover,
        .resp-sharing-button--facebook:active {
            background-color: #2d4373;
            border-color: #2d4373;
        }

        .resp-sharing-button--twitter {
            background-color: #55acee;
            border-color: #55acee;
        }

        .resp-sharing-button--twitter:hover,
        .resp-sharing-button--twitter:active {
            background-color: #2795e9;
            border-color: #2795e9;
        }

        .resp-sharing-button--whatsapp {
            background-color: #25D366;
            border-color: #25D366;
        }

        .resp-sharing-button--whatsapp:hover,
        .resp-sharing-button--whatsapp:active {
            background-color: #1DA851;
            border-color: #1DA851;
        }

        .resp-sharing-button--telegram {
            background-color: #54A9EB;
        }

        .resp-sharing-button--telegram:hover {
            background-color: #4B97D1;
        }



    </style>
@endsection
@section('content')





    <div class="services-wrapper bg-white py-5">
        <div class="container">
            <p style="font-weight: 800;font-size:1.3rem; color:#241332" class="pb-0 mb-3 text-center">{{$liveBook->name}}
            </p>
            <div class="row">

                <div class="col-md-3 mr-3">
                    <div class="row">
                        <div class="col-md-12 bg-light m-1" style="border: 1.5px solid #b0abab;">
                            <ul class="m-2">
                                <li class="float-right mb-3">
                                    <button class="btn btn-outline-primary d-none d-lg-block" type="button" data-toggle="modal" data-target="#share">
                                        Share <i class="fa fa-share-square"></i> </button>

                                </li>
                                <li class="mt-3">
                                    <img src="{{asset($liveBook->cover)}}" style="width:100%" alt="">
                                </li>
                                <li class="mt-3"> <p> <b>Book Name : {{$liveBook->name}} </b></p> </li>
                                <li class="mt-3"> <p> <b>Author : {{$liveBook->provider->User->name}} </b></p> </li>
                                <li class="mt-3"> <p> <b>Book Description : {{$liveBook->description}} </b></p> </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12 bg-light p-0"  style="border: 1.5px solid #b0abab;">
                            <div >
                                {{$pages->links()}}
                                {{--                        <button class="btn btn-transparent-primary" > <i class="fa fa-arrow-alt-circle-left"></i> Previews</button>--}}
                                {{--                            <p class="p-0 m-0"><b>Page 1</b></p>--}}
                                {{--                        <button class="btn btn-transparent-primary"> Next <i class="fa fa-arrow-alt-circle-right"></i> </button>--}}
                            </div>
                        </div>
                        <div class="col-md-12 p-3 bg-light" style="
                        overflow:scroll;
                        border: 1.5px solid #b0abab;">
                            @foreach($pages as $page)

                                {!! $page->content !!}
                            @endforeach
                        </div>
                        <div class="col-md-12 bg-light p-0"  style="border: 1.5px solid #b0abab;">
                            <div >
                                {{$pages->links()}}
                                {{--                        <button class="btn btn-transparent-primary" > <i class="fa fa-arrow-alt-circle-left"></i> Previews</button>--}}
                                {{--                            <p class="p-0 m-0"><b>Page 1</b></p>--}}
                                {{--                        <button class="btn btn-transparent-primary"> Next <i class="fa fa-arrow-alt-circle-right"></i> </button>--}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="share" tabindex="-1" role="dialog" aria-labelledby="shareLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body border-0">
                    <div class="d-flex justify-content-start">

                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Link</label>
                                    <textarea style="resize: none;" name="" readonly="" class="form-control" id="" cols="30" rows="1">{{url()->full()}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- Sharingbutton Facebook -->
                                <a class="resp-sharing-button__link fbc-has-badge fbc-UID_1" href="https://facebook.com/sharer/sharer.php?u={{url()->full()}}" target="_blank" rel="noopener" aria-label="Share on Facebook">
                                    <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--large">
                                        <div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"></path>
                                            </svg>
                                        </div>Share on Facebook
                                    </div>
                                </a>

                                <!-- Sharingbutton Twitter -->
                                <a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text=Follow Me Here &amp;url={{url()->full()}}" target="_blank" rel="noopener" aria-label="Share on Twitter">
                                    <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--large">
                                        <div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"></path>
                                            </svg>
                                        </div>Share on Twitter
                                    </div>
                                </a>

                                <!-- Sharingbutton E-Mail -->
                                <a class="resp-sharing-button__link" href="mailto:?subject=Follow Me Here &amp;body={{url()->full()}}" target="_self" rel="noopener" aria-label="Share by E-Mail">
                                    <div class="resp-sharing-button resp-sharing-button--email resp-sharing-button--large">
                                        <div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path d="M22 4H2C.9 4 0 4.9 0 6v12c0 1.1.9 2 2 2h20c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM7.25 14.43l-3.5 2c-.08.05-.17.07-.25.07-.17 0-.34-.1-.43-.25-.14-.24-.06-.55.18-.68l3.5-2c.24-.14.55-.06.68.18.14.24.06.55-.18.68zm4.75.07c-.1 0-.2-.03-.27-.08l-8.5-5.5c-.23-.15-.3-.46-.15-.7.15-.22.46-.3.7-.14L12 13.4l8.23-5.32c.23-.15.54-.08.7.15.14.23.07.54-.16.7l-8.5 5.5c-.08.04-.17.07-.27.07zm8.93 1.75c-.1.16-.26.25-.43.25-.08 0-.17-.02-.25-.07l-3.5-2c-.24-.13-.32-.44-.18-.68s.44-.32.68-.18l3.5 2c.24.13.32.44.18.68z"></path>
                                            </svg></div>Share by E-Mail
                                    </div>
                                </a>

                                <!-- Sharingbutton LinkedIn -->
                                <a class="resp-sharing-button__link" href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{url()->full()}}&amp;title=Follow Me Here &amp;summary=Follow Me Here &amp;source={{url()->full()}}" target="_blank" rel="noopener" aria-label="Share on LinkedIn">
                                    <div class="resp-sharing-button resp-sharing-button--linkedin resp-sharing-button--large">
                                        <div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path d="M6.5 21.5h-5v-13h5v13zM4 6.5C2.5 6.5 1.5 5.3 1.5 4s1-2.4 2.5-2.4c1.6 0 2.5 1 2.6 2.5 0 1.4-1 2.5-2.6 2.5zm11.5 6c-1 0-2 1-2 2v7h-5v-13h5V10s1.6-1.5 4-1.5c3 0 5 2.2 5 6.3v6.7h-5v-7c0-1-1-2-2-2z"></path>
                                            </svg>
                                        </div>Share on LinkedIn
                                    </div>
                                </a>

                                <!-- Sharingbutton WhatsApp -->
                                <a class="resp-sharing-button__link" href="whatsapp://send?text=Follow Me Here %20{{url()->full()}}" target="_blank" rel="noopener" aria-label="Share on WhatsApp">
                                    <div class="resp-sharing-button resp-sharing-button--whatsapp resp-sharing-button--large">
                                        <div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path d="M20.1 3.9C17.9 1.7 15 .5 12 .5 5.8.5.7 5.6.7 11.9c0 2 .5 3.9 1.5 5.6L.6 23.4l6-1.6c1.6.9 3.5 1.3 5.4 1.3 6.3 0 11.4-5.1 11.4-11.4-.1-2.8-1.2-5.7-3.3-7.8zM12 21.4c-1.7 0-3.3-.5-4.8-1.3l-.4-.2-3.5 1 1-3.4L4 17c-1-1.5-1.4-3.2-1.4-5.1 0-5.2 4.2-9.4 9.4-9.4 2.5 0 4.9 1 6.7 2.8 1.8 1.8 2.8 4.2 2.8 6.7-.1 5.2-4.3 9.4-9.5 9.4zm5.1-7.1c-.3-.1-1.7-.9-1.9-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.1-.2.2-.3.2-.6.1s-1.2-.5-2.3-1.4c-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6s.3-.3.4-.5c.2-.1.3-.3.4-.5.1-.2 0-.4 0-.5C10 9 9.3 7.6 9 7c-.1-.4-.4-.3-.5-.3h-.6s-.4.1-.7.3c-.3.3-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.3.2-.7.2-1.2.2-1.3-.1-.3-.3-.4-.6-.5z"></path>
                                            </svg>
                                        </div>Share on WhatsApp
                                    </div>
                                </a>

                                <!-- Sharingbutton Telegram -->
                                <a class="resp-sharing-button__link" href="https://telegram.me/share/url?text=Follow Me Here &amp;url={{url()->full()}}" target="_blank" rel="noopener" aria-label="Share on Telegram">
                                    <div class="resp-sharing-button resp-sharing-button--telegram resp-sharing-button--large">
                                        <div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path d="M.707 8.475C.275 8.64 0 9.508 0 9.508s.284.867.718 1.03l5.09 1.897 1.986 6.38a1.102 1.102 0 0 0 1.75.527l2.96-2.41a.405.405 0 0 1 .494-.013l5.34 3.87a1.1 1.1 0 0 0 1.046.135 1.1 1.1 0 0 0 .682-.803l3.91-18.795A1.102 1.102 0 0 0 22.5.075L.706 8.475z"></path>
                                            </svg>
                                        </div>Share on Telegram
                                    </div>
                                </a>


                            </div>


                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/3/turn.min.js" integrity="sha512-rFun1mEMg3sNDcSjeGP35cLIycsS+og/QtN6WWnoSviHU9ykMLNQp7D1uuG1AzTV2w0VmyFVpszi2QJwiVW6oQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript" src="{{asset('assets/plugins/turnjs4/extras/modernizr.2.5.3.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.service-slider').slick({
                infinite: true,
                slidesToShow: 6,
                slidesToScroll: 6,
                centerMode: true,
                centerPadding: '60px',
                adaptiveHeight: true,
                responsive:[
                    {
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
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]

            });
            $('.freelance-slider').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 4,
                centerMode: true,
                centerPadding: '60px',
                adaptiveHeight: true,
                responsive:[
                    {
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
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]

            });
            $('.main-slider').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 2000,
                fade: true,
            });
        })
        //   freelance-slider

    </script>
    <script type="text/javascript">
        $("#flipbook").turn({

            autoCenter: true
        });
    </script>
@endsection
