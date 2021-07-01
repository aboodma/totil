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
                @include('parts.customer_sidebar')
            </div>
            <div class="col-lg-8 right">
                <div class="p-4 bg-white rounded shadow-sm my-3">
                    <h6 class="mb-2 font-weight-bold">{{__('My Wallet')}}
                    </h6>
                    <div class="row">
                        <div class="col-md-12">
                            <button  data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-success float-right"><i class="fas fa-plus"></i> Add Funds To wallet</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="table-responsive box-table mt-4 bg-white rounded shadow-sm p-2">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>{{__('Date')}}</th>
                                            <th>{{__('Type')}}</th>
                                            <th>{{__('Amount')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($wallets as $wallet)
                                        <tr>
                                            <td>{{$wallet->created_at->diffForHumans()}}</td>
                                            <td class="@if($wallet->transaction_type == 0) text-success @else text-danger @endif"> @if($wallet->transaction_type == 0) {{__('Income')}} @else {{__('Payment')}} @endif </td>
                                            <td class="text-success">@if($wallet->transaction_type == 0) + @else - @endif {{$wallet->amount}} USD </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="border-right-0"><b>{{__('Total Wallet Balance')}}</b></td>
                                            <td class="border-right-0 border-left-0"></td>
                                            <td class="border-left-0"><b>{{auth()->user()->wallets->where('transaction_type',0)->sum('amount') - auth()->user()->wallets->where('transaction_type',1)->sum('amount')}} USD</b></td>
                                        </tr>
                                    </tfoot>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Funds To Your Wallet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('customer.payForFunds')}}" method="post">
            @csrf

        <div class="modal-body">
            <div class="form-group">
                <label for="funds">Select The Funds Amount</label>
                <select class="form-control" name="funds" id="funds">
                    <option value="10">10 USD</option>
                    <option value="20">20 USD</option>
                    <option value="50">50 USD</option>
                    <option value="100">100 USD</option>
                    <option value="200">200 USD</option>
                </select>
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary">Submit</button>
        </div>
    </form>
        
    </div>
    </div>
  </div>
@endsection
