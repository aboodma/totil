@extends('layouts.website')
@section('style')
<style>
    .menu-item {
        color: #000;
        font-size: 14px;
    }

    .active-menu {
        font-weight: bolder;
        color: #04808B !important;
    }

</style>

@endsection
@section('content')
<div class="main-page second py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                @include('parts.provider_sidebar')
            </div>
            <div class="col-lg-8 right">
                
                <div class="p-4 bg-white rounded shadow-sm mb-3">
                    <h5 class="mb-4 font-weight-bold text-center">{{__('Order Procced')}}
                    </h5>
                    <div class="row">
                        <div class="col-md-12">
                           <div class="card bg-light">
                               <div class="card-header bg-white">
                                {{$order->service->name}}
                               </div>
                               <div class="card-body">
                                {{$order->service->description}}
                               </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-header bg-white">
                                    {{__('Order Inforamtions')}}
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-stiped">
                                            
                                            <tbody>
                                                <tr>
                                                    <th>{{__('Customer Name')}}</th>
                                                    <td>{{$order->user->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{__('To')}}</th>
                                                    <td>{{$order->details->to}}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{__('Message')}}</th>
                                                    <td>{{$order->details->customer_message}}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{__('Total Price')}}</th>
                                                    <td>{{$order->total_price}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-header bg-white">
                                    {{__('Order Procced')}}
                                </div>
                                <div class="card-body">
                                   @if ($order->service->is_video)
                                   <form action="{{route('provider.video_order_upload')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <div class="form-group">
                                        <label for="">
                                            {{__('Video Upload')}}
                                        </label>
                                        <input type="file" name="video" accept="video/*" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <div class="progress" id="progress" >
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-success">{{__('Upload')}}</button>
                                    </div>
                                </form>
                                
                                @else
                                    <form action="{{route('provider.other_order_upload')}}" method="POST">
                                        @csrf
                                    <input type="hidden" name="order_id" value="{{$order->id}}">

                                        <div class="form-group">
                                            <label for="">
                                                    {{__('Provider Note')}}
                                            </label>
                                            <textarea name="provider_note" class="form-control" id="" cols="30" rows="5"></textarea>
                                        </div>
                                        <div class="form-group row ">
                                            <button class="btn btn-primary rd-in btn-block">{{__('Procced')}}</button>
                                        </div>

                                    </form>
                                   @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            centerMode: true,
            centerPadding: '60px',
            // adaptiveHeight: true,

        });
    })
    //   freelance-slider

</script>
@if ($order->service->is_video)
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
            // console.log(xhr.responseText);
            
        },
        success : function(xhr){
            console.log(xhr.responseText);
        window.location.replace('{{route("provider.orders","onGoing")}}')
        },
        error:function(xhr){
            const obj = JSON.parse(xhr.responseText);
            $("#errors-warper").show();
            // $("#errors").html(obj.message);
            // for (let index = 0; index < obj.errors; index++) {
            //     console.log(obj.errors[index]);
                
            // }
        }
       
        
      });
   }); 
 });
</script>
@endif
@endsection
