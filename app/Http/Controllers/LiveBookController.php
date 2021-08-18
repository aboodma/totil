<?php

namespace App\Http\Controllers;

use App\LiveBook;
use App\LiveBookPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LiveBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = auth()->user()->provider->liveBooks;


        return view('website.provider.live_books',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('website.provider.create_live_book');
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
        $random = Str::random(40);
        $cover_path = $request->file('book_cover');
        $filename = $cover_path->getClientOriginalName();
        $cover = explode('.', $filename);
        $cover = $random . '.' . $cover_path->extension();
        $cover_file = $cover_path->move(public_path() . "/live_book_cover/", $cover);
        $live_book = new LiveBook();
        $live_book->provider_id = auth()->user()->provider->id;
        $live_book->name = $request->title;
        $live_book->description = $request->description;
        $live_book->cover =   "/live_book_cover/" . $cover;
        $live_book->slug = Str::slug($request->title, $separator = '-', $language = 'ar');
        $live_book->publish = true;
        $live_book->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LiveBook  $liveBook
     * @return \Illuminate\Http\Response
     */
    public function show(LiveBook $liveBook)
    {
       return view('website.provider.show_live_book',compact('liveBook'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LiveBook  $liveBook
     * @return \Illuminate\Http\Response
     */
    public function edit(LiveBook $liveBook)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LiveBook  $liveBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiveBook $liveBook)
    {
        //
    }

    public function read(LiveBook $liveBook){
        $pages = LiveBookPage::where('live_book_id',$liveBook->id)->paginate(1);

        return view('website.read_live_book',compact('liveBook','pages'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LiveBook  $liveBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(LiveBook $liveBook)
    {
        //
    }
}
