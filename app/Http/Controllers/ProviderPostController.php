<?php

namespace App\Http\Controllers;

use App\ProviderPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProviderPostController extends Controller
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
        $post = new ProviderPost();
        $post->provider_id = auth()->user()->provider->id;
        $post->body = $request->get('body');
        $post->text_color = $request->get('color');
        $post->background_class = $request->get('background');
        if ($request->has('file')) {
            $random = Str::random(40);
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $newName = explode('.', $filename);
            $newName = $random . '.' . $file->extension();
            $fil = $file->move(public_path()."/uploads/posts/", $newName);


            $post->file = "uploads/posts/".$newName;

        }
        if ($post->save()){
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProviderPost  $providerPost
     * @return \Illuminate\Http\Response
     */
    public function show(ProviderPost $providerPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProviderPost  $providerPost
     * @return \Illuminate\Http\Response
     */
    public function edit(ProviderPost $providerPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProviderPost  $providerPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProviderPost $providerPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProviderPost  $providerPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProviderPost $providerPost)
    {
        //
    }
}
