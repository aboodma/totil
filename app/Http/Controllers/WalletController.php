<?php

namespace App\Http\Controllers;

use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function provider_wallet()
    {
        $wallets = auth()->user()->wallets;
        return view('website.provider.wallet', compact('wallets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
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
     * @param Wallet $wallet
     * @return Response
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Wallet $wallet
     * @return Response
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Wallet $wallet
     * @return Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Wallet $wallet
     * @return Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
