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

    </style>
@endsection
@section('content')





    <div class="services-wrapper bg-white py-5">
        <div class="container">
            <p style="font-weight: 800;font-size:1.3rem; color:#241332" class="pb-0 mb-3 text-center">{{$liveBook->name}}
            </p>
            <div class="row">

                <div class="col-md-12 bg-light p-0"  style="border: 1.5px solid #b0abab;">
                    <div >
                        {{$pages->links()}}
{{--                        <button class="btn btn-transparent-primary" > <i class="fa fa-arrow-alt-circle-left"></i> Previews</button>--}}
{{--                            <p class="p-0 m-0"><b>Page 1</b></p>--}}
{{--                        <button class="btn btn-transparent-primary"> Next <i class="fa fa-arrow-alt-circle-right"></i> </button>--}}
                    </div>
                </div>
                <div class="col-md-12 p-3 bg-light" style="border: 1.5px solid #b0abab;">
                    @foreach($pages as $page)

                        {!! $page->content !!}
                        @endforeach
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
