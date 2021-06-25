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
                    <h5 class="mb-4 font-weight-bold text-center">{{__('Create Book')}}
                    </h5>
                    <div class="row py-2">
                        <div class="col-md-12">
                            <table class="table  table-border">
                                <tbody>
                                    <tr>
                                        <th>Book Title</th>
                                        <td>{{$book->title}}</td>
                                        <th>Book Description</th>
                                        <td>{{$book->description}}</td>
                                    </tr>
                                    <tr>
                                        <th>Book publisbher</th>
                                        <td>{{$book->publisher}}</td>
                                        <th>Book pages count</th>
                                        <td>{{$book->pages_count}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12  ">
                           <form action="{{route('provider.books.service.store',$book->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                               
                               <div class="form-group">
                                   <label for="">Services</label>
                                   <select name="service_id" class="form-control" id="">
                                       <option value="">Please Select Service</option>
                                       @foreach($services as $service)
                                       <option value="{{$service->id}}">{{$service->name}}</option>
                                       @endforeach
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label for="">Price</label>
                                   <input type="number" class="form-control" name="price" >
                               </div>
                               <div class="form-group">
                                   <label for="">File</label>
                                   <input type="file" class="form-control" name="file">
                               </div>
                               
                               <div class="form-group">
                                   <button class="form-control btn btn-success" type="submit">Save</button>
                               </div>
                           </form>
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
