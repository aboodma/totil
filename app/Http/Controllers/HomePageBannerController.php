<?php

namespace App\Http\Controllers;

use App\HomePageBanner;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomePageBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        return view('backend.homepage.banners');
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        $languages = Language::all();
        return view('backend.homepage.create_banner', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        $random = Str::random(40);
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $newName = explode('.', $filename);
        $newName = "big_" . $random . '.' . $file->getClientOriginalExtension();
        $fil = $file->move(public_path() . "/uploads/banners/", $newName);

        $file_sm = $request->file('image_small');
        $filename_sm = $file_sm->getClientOriginalName();
        $newName_sm = explode('.', $filename_sm);
        $newName_sm = "sm_" . $random . '.' . $file_sm->getClientOriginalExtension();
        $fil_sm = $file_sm->move(public_path() . "/uploads/banners/", $newName_sm);
        $homePageBanner = new HomePageBanner();
        $homePageBanner->text_1 = $request->text1;
        $homePageBanner->text_2 = $request->text2;
        $homePageBanner->button_text = $request->button_text;
        $homePageBanner->image = "/uploads/banners/" . $newName;
        $homePageBanner->small_image = "/uploads/banners/" . $newName_sm;
        $homePageBanner->locale = $request->lang;
        $homePageBanner->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param HomePageBanner $homePageBanner
     *
     */
    public function show(HomePageBanner $homePageBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param HomePageBanner $homePageBanner
     *
     */
    public function edit(HomePageBanner $homePageBanner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param HomePageBanner $homePageBanner
     *
     */
    public function update(Request $request, HomePageBanner $homePageBanner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param HomePageBanner $homePageBanner
     *
     */
    public function destroy(HomePageBanner $HomePageBanner)
    {

        if ($HomePageBanner->delete()) {
            return redirect()->back();
        }
        return redirect()->back();
    }
}
