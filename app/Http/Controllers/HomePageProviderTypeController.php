<?php

namespace App\Http\Controllers;

use App\HomePageProviderType;
use Illuminate\Http\Request;

class HomePageProviderTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.homepage.categories');
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
        $homePageProviderType = new HomePageProviderType();
        $homePageProviderType->provider_type_id = $request->provider_type_id;
        $homePageProviderType->limit = 5;
        if ($homePageProviderType->save()) {
            return redirect()->route('admin.homePage.categories');
        } else {
            return redirect()->route('admin.homePage.categories');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HomePageProviderType  $homePageProviderType
     * @return \Illuminate\Http\Response
     */
    public function show(HomePageProviderType $homePageProviderType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HomePageProviderType  $homePageProviderType
     * @return \Illuminate\Http\Response
     */
    public function edit(HomePageProviderType $homePageProviderType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HomePageProviderType  $homePageProviderType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomePageProviderType $homePageProviderType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HomePageProviderType  $homePageProviderType
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomePageProviderType $homePageProviderType)
    {
        if ($homePageProviderType->delete()) {
            return redirect()->route('admin.homePage.categories');
        } else {
            return redirect()->route('admin.homePage.categories');
        }
    }
}
