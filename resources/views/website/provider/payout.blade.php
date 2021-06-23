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
                <div class="p-4 bg-white rounded shadow-sm my-3">
                    <h6 class="mb-2 font-weight-bold">{{__('Payout Requests')}}
                    </h6>

                    <div class="row">
                        <div class="col-md-12">
                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-success float-right rd-in">Request a Payout</button>
                            <div class="table-responsive box-table mt-4 bg-white rounded shadow-sm p-2">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>{{__('Date')}}</th>
                                            <th>{{__('Status')}}</th>
                                            <th>{{__('Amount')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payouts as $payout)
                                        <tr>
                                            <td>{{$payout->created_at->diffForHumans()}}</td>
                                            <td class="@if($payout->status == 0)
                                                text-warning 
                                                @elseif($payout->status == 1)
                                                text-primary
                                                @elseif($payout->status == 2)
                                                text-success
                                                @elseif($payout->status == 3)
                                                text-danger
                                                 @endif "> 
                                                 <b>
                                                @if($payout->status == 0)
                                                 {{__('Reviewing')}} 
                                                 @elseif($payout->status == 1)
                                                 {{__('Confirmed')}}
                                                 @elseif($payout->status == 2)
                                                 {{__('Paid')}}
                                                 @elseif($payout->status == 3)
                                                 {{__('Rejected')}}
                                                  @endif 
                                                </b>
                                                </td>
                                            <td class="text-dark"><b>{{$payout->amount}} USD</b> </td>
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
      <div class="modal-content">
        <form action="{{route('provider.payouts_request')}}" method="POST">
            @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('Request a Payout')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <div class="form-group">
                  <label for="">{{__('Amount')}} (USD)</label>
                  <input type="number" name="amount" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="">{{__('Account Owner Name')}} </label>
                <input type="text" name="account_name" disabled value="{{auth()->user()->provider->account_name}}" class="form-control" required>
            </div>
              <div class="form-group">
                <label for="">{{__('IBAN')}}</label>
                <input type="text" name="iban" disabled value="{{auth()->user()->provider->iban}}" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{__('Close')}}</button>
          <button type="submit" class="btn btn-success">{{__('Send Request')}}</button>
        </div>
        </form>

      </div>
    </div>
  </div>
@endsection
