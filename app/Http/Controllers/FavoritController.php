<?php

namespace App\Http\Controllers;

use App\Favorit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FavoritController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function favorits()
    {
        return view('website.customer.favorits');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function addToFavorit(Request $request)
    {
        $fav = new Favorit();
        $fav->user_id = auth()->user()->id;
        $fav->provider_id = $request->id;
        $fav->save();
    }

    public function removeFromFavorit(Request $request)
    {

        $fav = Favorit::where(['user_id' => auth()->user()->id, 'provider_id' => $request->id])->first();
        return $fav->delete();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Favorit $favorit
     * @return Response
     */
    public function show(Favorit $favorit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Favorit $favorit
     * @return Response
     */
    public function edit(Favorit $favorit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Favorit $favorit
     * @return Response
     */
    public function update(Request $request, Favorit $favorit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Favorit $favorit
     * @return Response
     */
    public function destroy(Favorit $favorit)
    {
        //
    }
}
