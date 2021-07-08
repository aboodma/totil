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
                    <h5 class="mb-4 font-weight-bold text-center">{{$book->title}}
                    </h5>
                    <div class="row ">
                        <div class="col-md-12  ">
                           
                           <legend>Book Service Files</legend>
                           <table class="table table-stiped">
                               <thead>
                                   <tr>
                                       <th>Service Title</th>
                                       <th>Service File Path</th>
                                       <th>Service Price</th>
                                       <th>Options</th>
                                   </tr>
                               </thead>
                               <tbody>
                                    @foreach($files as $file)
                                   <tr>
                                       <td>{{$file->bookService->service->name}}</td>
                                       
                                       <td>{{$file->bookService->price}}</td>
                                       <td nowrap>
                                    
                                        <a href="{{route('provider.books.service.show',$book->id)}}" class="btn btn-success btn-sm"><i class="fas fa-trash"></i> </a>       
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
<script>
    
</script>
@endsection
