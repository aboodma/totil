@extends('layouts.website')
@section('style')
<style>
    .menu-item {
        color: #000;
        font-size: 14px;
    }

    .active-menu {
        font-weight: bolder;
        color: #d47fa6 !important;
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
                    <h5 class="mb-4 font-weight-bold text-center">{{__('My Books')}}
                    </h5>
                    <div class="row ">
                        <div class="col-md-12 py-2 ">
                            <a href="{{route('provider.books.create')}}" class="btn btn-success float-right">Add Book</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                           <div class="table-responsive">
                               <table class="table  table-hover table-bordered">
                                   <thead class="thead-dark">
                                       <tr>
                                        <th>{{__('ID')}}</th>
                                        <th>{{__('Book Title')}}</th>
                                        <th>{{__('Release Year')}}</th>
                                        <th>{{__('Publisher')}}</th>
                                        <th>{{__('Pages Count')}}</th>
                                        <th>{{__('Services Count')}}</th>
                                        <th>{{__('Services Options')}}</th>
        
                                    </tr>                                   
                                </thead>
                                   <tbody>
                                       @foreach ($books as $book)
                                       <tr>
                                        <td>{{$book->id}}</td>
                                        <td>{{$book->title}}</td>
                                        <td>{{$book->release_year}}</td>
                                        <td>{{$book->publisher}}</td>
                                        <td>{{$book->pages_count }}</td>
                                        <td>{{$book->services->count()}}</td>
                                       
                                        
                                  
                                         <td>
                                            <a href="{{route('provider.books.service.create',$book->id)}}" class="btn btn-success btn-sm"><i class="fas fa-plus-square"></i> </a>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" id="modal-content">
       
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
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('order') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        $.ajax({
            url:"{{route('provider.showOrderDetails')}}",
            type:"POST",
            data:{
                "_token":"{{csrf_token()}}",
                "order_id":recipient
            },
            success : function(res){
                $("#modal-content").html(res);
            }
        })
        })
</script>
@endsection
