<?php

namespace App\Http\Controllers;

use App\OrderReview;
use Illuminate\Http\Request;

class OrderReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rateOrder (Request $request)
    {
        // return $request;
        $order_review = new OrderReview();
        $order_review->order_id = $request->order_id;
        $order_review->user_id = auth()->user()->id;
        $order_review->rate = $request->rate;
        $order_review->massage = $request->message;
        if ($order_review->save()) {
            return redirect()->route('customer.orders');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderReview  $orderReview
     * @return \Illuminate\Http\Response
     */
    public function show(OrderReview $orderReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderReview  $orderReview
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderReview $orderReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderReview  $orderReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderReview $orderReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderReview  $orderReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderReview $orderReview)
    {
        //
    }
}
