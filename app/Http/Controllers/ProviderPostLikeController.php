<?php

namespace App\Http\Controllers;

use App\ProviderPost;
use App\ProviderPostLike;
use Illuminate\Http\Request;

class ProviderPostLikeController extends Controller
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
//        return $request->all();
        $like =  new ProviderPostLike();
        $like->provider_post_id = $request->post_id;
        $like->user_id = auth()->user()->id;
        $like->save();

    }

    public function unlike(Request $request )
    {
        $postLike = ProviderPostLike::where(['provider_post_id' => $request->post_id,'user_id'=>auth()->user()->id])->first();
        $postLike->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProviderPostLike  $providerPostLike
     * @return \Illuminate\Http\Response
     */
    public function show(ProviderPostLike $providerPostLike)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProviderPostLike  $providerPostLike
     * @return \Illuminate\Http\Response
     */
    public function edit(ProviderPostLike $providerPostLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProviderPostLike  $providerPostLike
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProviderPostLike $providerPostLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProviderPostLike  $providerPostLike
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProviderPostLike $providerPostLike)
    {
        //
    }
}
