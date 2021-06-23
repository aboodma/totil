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
                    <h6 class="mb-2 font-weight-bold">{{__('My Wallet')}}
                    </h6>

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
                                            <td class="@if($wallet->transaction_type == 0) text-success @else text-danger @endif"> @if($wallet->transaction_type == 0) {{__('Income')}} @else {{__('Payout')}} @endif </td>
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

@endsection
