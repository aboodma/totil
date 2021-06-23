@extends('layouts.website')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<style>
    .menu-item {
        color: #000;
        font-size: 14px;
    }

    .active-menu {
        font-weight: bolder;
        color: #d47fa6 !important;
    }

    .wrap {
        width: 250px;
        height: 50px;
        background: #fff;

        /* transform: translate(-50%,-50%); */
        border-radius: 10px;
    }

    .stars {
        width: fit-content;
        margin: 0 auto;
        cursor: pointer;
    }

    .star {
        color: #d47fa6 !important;
    }

    .rate {
        height: 50px;
        margin-left: -5px;
        padding: 5px;
        font-size: 25px;
        position: relative;
        cursor: pointer;
    }

    .rate input[type="radio"] {
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, 0%);
        pointer-events: none;
    }

    .star-over::after {
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        font-size: 16px;
        content: "\f005";
        display: inline-block;
        color: #d47fa6;
        z-index: 1;
        position: absolute;
        top: 17px;
        left: 10px;
    }

    .rate:nth-child(1) .face::after {
        content: "\f119";
        /* ☹ */
    }

    .rate:nth-child(2) .face::after {
        content: "\f11a";
        /* 😐 */
    }

    .rate:nth-child(3) .face::after {
        content: "\f118";
        /* 🙂 */
    }

    .rate:nth-child(4) .face::after {
        content: "\f580";
        /* 😊 */
    }

    .rate:nth-child(5) .face::after {
        content: "\f59a";
        /* 😄 */
    }

    .face {
        opacity: 0;
        position: absolute;
        width: 35px;
        height: 35px;
        background: #d47fa6;
        border-radius: 5px;
        top: -50px;
        left: 2px;
        transition: 0.2s;
        pointer-events: none;
    }

    .face::before {
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        content: "\f0dd";
        display: inline-block;
        color: #d47fa6;
        z-index: 1;
        position: absolute;
        left: 9px;
        bottom: -15px;
    }

    .face::after {
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        display: inline-block;
        color: #fff;
        z-index: 1;
        position: absolute;
        left: 5px;
        top: -1px;
    }

    .rate:hover .face {
        opacity: 1;
    }
    .rd-in {
        border-radius: 20px;
    }
    .message::placeholder{
        font-size: smaller;
    }

    /* Not sure if I like this or not. */
    /* Makes the emoji stay displayed */
    /* input[type="radio"]:checked + .face {
	opacity: 1 !important;
} */

</style>

@endsection
@section('content')
<div class="main-page second py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                @include('parts.customer_sidebar')
            </div>
            <div class="col-lg-8 right">

                <div class="p-4 bg-white rounded shadow-sm mb-3">
                    <h5 class="mb-4 font-weight-bold text-center">{{__('My Orders')}}
                    </h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table  table-hover table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>{{__('ID')}}</th>
                                            <th>{{__('Service Name')}}</th>
                                            <th>{{__('Provider Name')}}</th>
                                            <th>{{__('Status')}}</th>
                                            <th>{{__('Total Price')}}</th>
                                            <th>{{__('Options')}}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->service->name}}</td>
                                            <td>{{$order->provider->user->name}}</td>
                                            <td>@if ($order->status == 0)
                                                <span class="badge badge-warning">{{__('Pending')}}</span>
                                                @elseif($order->status == 1)
                                                <span class="badge badge-warning">{{__('Accepted')}}</span>
                                                @elseif($order->status == 2)
                                                <span class="badge badge-success">{{__('Completed')}}</span>
                                                @elseif($order->status == 3)
                                                <span class="badge badge-danger">{{__('Rejected')}}</span>
                                                @endif</td>
                                            <td>{{$order->total_price}}</td>
                                            <td>
                                               <div class="btn-group">
                                                <a href="{{route('customer.OrderTracking',Crypt::encrypt($order->id))}}"
                                                    class="btn btn-info"> {{__('Order Tracking')}} <i class="fa fa-eye"></i>
                                                </a>
                                                
                                                @if ($order->status == 2 && !isset($order->rate) )
                                                <button type="button" data-toggle="modal"
                                                data-order="{{$order->id}}"
                                                    data-target="#exampleModalCenter" class="btn btn-success"> {{__('Review')}} <i
                                                        class="fa fa-star"></i> </button>
                                                @endif
                                               </div>
                                               
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg border-none" role="document">
        <div class="modal-content">
            <form action="{{route('customer.rate_order')}}" method="POST">
                @csrf
                 <input type="hidden" id="order_id" name="order_id" value="">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                           
                                <div class="form-group">
                                    <div class="p-3">
                                        <div class="first text-center"> <img src="https://i.imgur.com/KCcF6WN.png"
                                                width="80">
                                            <h3 class="mt-2 font-weight-bold">{{__('Thanks you')}}</h3>
                                            <p class="text-black-50">{{__('Thanks for been a great customer')}} <i style="color:#FFD452; font-size:18px" class="fa fa-crown"></i> <br> {{__('if you like the video please rate the service')}}  </p>
                                            <div class="">
                                                <div class="stars">
                                                    <label class="rate">
                                                        <input type="radio" name="rate" id="star1" value="1">
                                                        <div class="face"></div>
                                                        <i class="far fa-star star one-star"></i>
                                                    </label>
                                                    <label class="rate">
                                                        <input type="radio" name="rate" id="star2" value="2">
                                                        <div class="face"></div>
                                                        <i class="far fa-star star two-star"></i>
                                                    </label>
                                                    <label class="rate">
                                                        <input type="radio" name="rate" id="star3" value="3">
                                                        <div class="face"></div>
                                                        <i class="far fa-star star three-star"></i>
                                                    </label>
                                                    <label class="rate">
                                                        <input type="radio" name="rate" id="star4" value="4">
                                                        <div class="face"></div>
                                                        <i class="far fa-star star four-star"></i>
                                                    </label>
                                                    <label class="rate">
                                                        <input type="radio" name="rate" id="star5" value="5">
                                                        <div class="face"></div>
                                                        <i class="far fa-star star five-star"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                       
                                        <textarea placeholder="{{__('Please Write Your Massage Review')}}" name="message" class="form-control rd-in message" id="meassage" cols="30"
                                            rows="5"></textarea>
                                    </div>
                       
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{__('Rate Later')}}</button>
                <button type="submit" class="btn btn-success">{{__('Rate Now')}}</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('vendor/star-rate/src/bootstrap4-rating-input.js')}}"></script>
<script>
    $(document).ready(function () {
        $(function () {

            $(document).on({
                mouseover: function (event) {
                    $(this).find('.far').addClass('star-over');
                    $(this).prevAll().find('.far').addClass('star-over');
                },
                mouseleave: function (event) {
                    $(this).find('.far').removeClass('star-over');
                    $(this).prevAll().find('.far').removeClass('star-over');
                }
            }, '.rate');


            $(document).on('click', '.rate', function () {
                if (!$(this).find('.star').hasClass('rate-active')) {
                    $(this).siblings().find('.star').addClass('far').removeClass(
                        'fas rate-active');
                    $(this).find('.star').addClass('rate-active fas').removeClass(
                        'far star-over');
                    $(this).prevAll().find('.star').addClass('fas').removeClass(
                    'far star-over');
                } else {
                    console.log('has');
                }
            });

        });



        $('.service-slider').slick({
            infinite: true,
            slidesToShow: 6,
            slidesToScroll: 6,
            centerMode: true,
            centerPadding: '60px',
            // adaptiveHeight: true,

        });
    })
    //   freelance-slider
    $('#exampleModalCenter').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('order') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        $("#order_id").val(recipient);
        })
</script>
@endsection
