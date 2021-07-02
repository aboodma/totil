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
                           <table class="table table-strip">
                               <tbody>
                                   <tr>
                                       <th>Title</th>
                                       <td>{{$book->title}}</td>
                                   
                                    <th>Publisher</th>
                                    <td>{{$book->publisher}}</td>
                                </tr>
                                <tr>
                                    <th>Pages Count</th>
                                    <td>{{$book->pages_count}}</td>
                                
                                 <th>Release Year</th>
                                 <td>{{$book->release_year}}</td>
                             </tr>
                             <tr>
                                <th>Cover</th>
                                <td><a target="_blank" href="{{asset($book->cover_path)}}">Click Here</a></td>
                                <th>Audio Sample</th>
                                <td><a target="_blank" href="{{asset($book->audio_simple)}}">Click Here</a></td>
                                <th>Video Sample</th>
                                <td><a target="_blank" href="{{asset($book->video_simple)}}">Click Here</a></td>
                         </tr>
                             <tr>
                                <th>Description</th>
                                <td>{{$book->description}}</td>
                                <th></th>
                                <td></td>
                            </tr>
                                
                               </tbody>
                           </table>
                           <legend>Book Services</legend>
                           <table class="table table-stiped">
                               <thead>
                                   <tr>
                                       <th>Service Title</th>
                                       <th>Service File</th>
                                       <th>Service Price</th>
                                       <th>Options</th>
                                   </tr>
                               </thead>
                               <tbody>
                                    @foreach($book->services as $service)
                                   <tr>
                                       <td>{{$service->service->name}}</td>
                                       <td><a target="_blank" href="{{asset($service->file_path)}}">Click Here</a></td>
                                       <td>{{$service->price}}</td>
                                       <td nowrap>
                                        <a href="{{route('provider.books.service.show',$book->id)}}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> </a>       
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
