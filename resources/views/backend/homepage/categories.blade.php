@extends('layouts.backend')
@section('page_header','Categories List')
@section('page_toolbar')
<button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button>
@endsection
@section('content')

<div class="content flex-column-fluid" id="kt_content">
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Categories
                </h3>
            </div>
            
        </div>
        <div class="card-body">

            <!--begin: Datatable-->
            <table class="table table-bordered table-checkable" id="kt_datatable">
                <thead>
                    <tr>
                        <th title="Field #1">#</th>
                        <th title="Field #2">Category Name </th>
            
                        <th title="Field #8">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\HomePageProviderType::all() as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->providerType->name}}</td>

                        <td>
                            <form action="{{route('admin.homePage.categories.destroy',$category->id)}}" method="POST">
                              
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger"> <i class="fas fa-trash"></i> </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.homePage.categories.store')}}" method="POST">
            @csrf
        <div class="modal-body">
             <div class="form-group">
                 <label for="">Categories</label>
                 <select class="form-control" name="provider_type_id"  id="" required>
                     <option  value="">Select Category</option>
                     @foreach (App\ProviderType::whereNotIn('id',App\HomePageProviderType::all('provider_type_id'))->get() as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                     @endforeach
                 </select>
             </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">ADD</button>
        </div>
    </form>

      </div>
    </div>
  </div>
<!--end::Content-->
@endsection


@section('script')
  <script>

  </script>
@endsection
