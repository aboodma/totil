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
                                   <select required name="service_id" class="form-control" id="">
                                       <option value="">Please Select Service</option>
                                       @foreach($services as $service)
                                       <option value="{{$service->id}}">{{$service->name}}</option>
                                       @endforeach
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label required for="">Price</label>
                                   <input type="number" class="form-control" name="price" >
                               </div>
                               <div class="form-group">
                                   <label for="">File</label>
                                   <div class="input-group">
                                    <input required type="file" class="form-control" name="file[]">
                                    <div class="input-group-append">
                                        <button type="button" class="btn  btn-success" id="add_files"> <i class="fas fa-plus"></i> </button>
                                    </div>
                                   </div>
                               </div>
                               <div id="extra_fields_div"  >
                                
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
    var field_count = 0;
    $("#add_files").on("click",function(){
        var html  = "<div class='form-group' id='field_"+field_count+"'>";
            html += "<label for=''> File </label>";
            html += "<div class='input-group'>"
            html += "<input required type='file' class='form-control' name='file[]' >";
            html += '<div class="input-group-append">';
            html += '<button class="btn  btn-danger" type="button" onClick="remove_field(this)" data-id="'+field_count+'" > <i class="fas fa-trash"></i> </button>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
        $("#extra_fields_div").append(html);
        ++field_count; 
    })
    function remove_field(e) {
        var id = "#field_"+e.attributes["data-id"].value;
        $(id).remove();
    }
</script>
@endsection
