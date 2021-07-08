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
        color: #04808B !important;
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
        color: #04808B !important;
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
        color: #04808B;
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
        background: #04808B;
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
        color: #04808B;
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
                    <h5 class="mb-4 font-weight-bold text-center">{{$book->title}}
                    </h5>
                    <div class="row ">
                        <div class="col-md-12  ">
                           
                           <legend>Order Files</legend>
                           <table class="table table-stiped">
                               <thead>
                                   <tr>
                                       <th>Service Title</th>
                                       <th>Provider Name</th>
                                       <th>File Size / File Type</th>
                                      
                                       <th>Dowload File </th>
                                   </tr>
                               </thead>
                               <tbody>
                                    @foreach($files as $file)
                                   <tr>
                                       <td>{{$file->bookService->service->name}}</td>
                                       
                                       <td>{{$file->bookService->book->provider->user->name}}</td>
                                       <td>{{ (get_headers(asset($file->file_path), true)['Content-Length'] / 2048)}} KB  <br> {{getUrlMimeType(asset($file->file_path))}}</td>
                                       <td nowrap>
                                    
                                        <a download href="{{asset($file->file_path)}}" class="btn btn-success btn-sm"><i class="fas fa-download"></i> </a>       
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

@endsection
@section('script')

@endsection
