<?php

namespace App\Http\Controllers;

use App\PayoutRequest;
use App\Wallet;
use Illuminate\Http\Request;

class PayoutRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function provider_payouts()
    {
        $payouts = auth()->user()->payouts;
        return view('website.provider.payout',compact('payouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payouts = PayoutRequest::all();
        return view('backend.payouts.index',compact('payouts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function provider_payouts_request(Request $request)
    {
        $payout = new PayoutRequest();
        $payout->user_id = auth()->user()->id;
        $payout->amount = $request->amount;
        $payout->status = 0;
        $payout->admin_msg = "";
        $payout->details = "IBAN : ". $request->iban . " Account Owner Name : " .$request->account_name;
        if ($payout->save()) {
            return redirect()->route('provider.payouts');
        } else {
            return redirect()->route('provider.payouts');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PayoutRequest  $payoutRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PayoutRequest $payoutRequest)
    {
        return view('backend.payouts.show',compact('payoutRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PayoutRequest  $payoutRequest
     * @return \Illuminate\Http\Response
     */
    public function acceptRequest(Request $request , PayoutRequest $payoutRequest)
    {
      $payoutRequest->status = 1;
      $payoutRequest->save();
      return redirect()->back();
    }

    public function reject(Request $request)
    {
      $payout = PayoutRequest::find($request->request_id);
      $payout->status = 3;
      $payout->admin_msg = $request->admin_note;
      $payout->save();
      return redirect()->back();
    }
    public function paid(Request $request)
    {

      $payout = PayoutRequest::find($request->request_id);
      $payout->status = 2;
      $payout->admin_msg = $request->admin_note;
      if ($payout->save()) {
        $wallet  = new Wallet();
        $wallet->user_id = $payout->user_id;
        $wallet->amount = $payout->amount;
        $wallet->transaction_type = 1;
        $wallet->save();

      }
      return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PayoutRequest  $payoutRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayoutRequest $payoutRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PayoutRequest  $payoutRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayoutRequest $payoutRequest)
    {
        //
    }
}
