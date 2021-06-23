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
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center">
                            <p>
                                <img style="width: 81px" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0xMiAwYzYuNjIzIDAgMTIgNS4zNzcgMTIgMTJzLTUuMzc3IDEyLTEyIDEyLTEyLTUuMzc3LTEyLTEyIDUuMzc3LTEyIDEyLTEyem0wIDFjNi4wNzEgMCAxMSA0LjkyOSAxMSAxMXMtNC45MjkgMTEtMTEgMTEtMTEtNC45MjktMTEtMTEgNC45MjktMTEgMTEtMTF6bTcgNy40NTdsLTkuMDA1IDkuNTY1LTQuOTk1LTUuODY1Ljc2MS0uNjQ5IDQuMjcxIDUuMDE2IDguMjQtOC43NTIuNzI4LjY4NXoiLz48L3N2Zz4=">
                                </p>
                            
                        </div>
                        <div class="d-flex justify-content-center">
                            <p class="text-center" style="font-weight: 600; ">{{__('Your Request has been completed we will send you an email with all the details You can track your order from the website or with the link below')}}</p>


                        </div>
                        <div class="d-flex justify-content-center">
                        <a href="{{route('customer.OrderTracking',$d_order_id)}}" class="btn btn-success dark "> {{__('Track your Order')}}</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

                <img class="http://localhost/celebrate/narabana/public/images/video.png" src="" width="250" alt="">
            </div>
           
        </div>
     
    </div>







    @endsection
    @section('script')
    <script>
         function select_service(service_id,e) {
              $.ajax({
                  url:"{{route('service_check')}}",
                  type:"GET",
                data:{service_id:service_id},
                  success : function (re) {
                      $(".price").html(re.price + " USD");
                      $("#price").val(re.price);
                  }
              });
                $("#"+e.id).parent().toggleClass('active');
            }
        $(document).ready(function () {

            $('.freelance-slider').slick({
                infinite: true,
                slidesToShow: 5,
                slidesToScroll: 3,
                dir: "ltr",
                centerMode: true,
                centerPadding: '60px',
                // adaptiveHeight: true,

            });

           

        })
        //   freelance-slider

    </script>
    @endsection
