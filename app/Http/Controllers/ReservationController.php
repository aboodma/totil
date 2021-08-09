<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
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
    public function store(Request $request)
    {

       $reservation = new Reservation();
       $reservation->user_id = auth()->user()->id;
       $reservation->provider_id = $request->provider_id;
       $reservation->phone = $request->phone;
       $reservation->date = $request->date;
       $reservation->reservation_reason = $request->reservation_reason;
       $reservation->msg = $request->msg;
       if ($reservation->save()){
           return redirect()->back();
       }else{
           return redirect()->back();
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function customer_index()
    {
        $reservations = auth()->user()->Reservations;
        return view('website.customer.reservations',compact('reservations'));
    }

    public function provider_index()
    {

        $reservations = auth()->user()->Provider->Reservations;
        return view('website.provider.reservations',compact('reservations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
