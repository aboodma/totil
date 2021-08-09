<?php

namespace App\Http\Controllers;

use App\ProviderPostComment;
use Illuminate\Http\Request;

class ProviderPostCommentController extends Controller
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
    public function comment(Request $request)
    {
        $comment = new ProviderPostComment();
        $comment->provider_post_id = $request->post_id;
        $comment->user_id = auth()->user()->id;
        $comment->body = $request->body;
        $comment->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProviderPostComment  $providerPostComment
     * @return \Illuminate\Http\Response
     */
    public function show(ProviderPostComment $providerPostComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProviderPostComment  $providerPostComment
     * @return \Illuminate\Http\Response
     */
    public function edit(ProviderPostComment $providerPostComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProviderPostComment  $providerPostComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProviderPostComment $providerPostComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProviderPostComment  $providerPostComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProviderPostComment $providerPostComment)
    {
        //
    }
}
