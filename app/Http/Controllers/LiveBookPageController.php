<?php

namespace App\Http\Controllers;

use App\LiveBook;
use App\LiveBookPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LiveBookPageController extends Controller
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
    public function create(LiveBook $liveBook)
    {
        return view('website.provider.create_live_book_page',compact('liveBook'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,LiveBook $liveBook)
    {
        $page = new LiveBookPage();
        $page->live_book_id = $liveBook->id;
        $page->content = $request->content;
        $page->title = "no title";
        $page->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LiveBookPage  $liveBookPage
     * @return \Illuminate\Http\Response
     */
    public function show(LiveBookPage $liveBookPage)
    {
        return view('website.provider.view_live_book_page',compact('liveBookPage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LiveBookPage  $liveBookPage
     * @return \Illuminate\Http\Response
     */
    public function upload_live(Request $request)
    {
        if($request->hasFile('upload')) {

            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path() . "/live_book_contents/", $fileName);

            $url = asset('live_book_contents/'.$fileName);
            $msg = 'Image uploaded successfully';
            $response = '{
                    "uploaded": 1,
                    "fileName": "'.$fileName.'",
                    "url":  "'.$url.'"
            }';
            echo $response;

        }
//        $random = Str::random(40);
//        $cover_path = $request->file('upload');
//        $filename = $cover_path->getClientOriginalName();
//        $cover = explode('.', $filename);
//        $cover = $random . '.' . $cover_path->extension();
//        $cover_file = $cover_path->move(public_path() . "/live_book_contents/", $cover);
//        echo public_path() . "/live_book_contents/".$cover;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LiveBookPage  $liveBookPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiveBookPage $liveBookPage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LiveBookPage  $liveBookPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(LiveBookPage $liveBookPage)
    {
        //
    }
}
