<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $books = auth()->user()->provider->books;
        return view('website.provider.books', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('website.provider.add_book');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //    return $request->all();
        $random = Str::random(40);
        //Cover Upload
        $cover_path = $request->file('cover_path');
        $filename = $cover_path->getClientOriginalName();
        $cover = explode('.', $filename);
        $cover = $random . '.' . $cover_path->extension();
        $cover_file = $cover_path->move(public_path() . "/cover/", $cover);
        // Audio Upload
        $audio_simple = $request->file('audio_simple');
        $filename = $audio_simple->getClientOriginalName();
        $audio = explode('.', $filename);
        $audio = $random . '.' . $audio_simple->extension();
        $audio_file = $audio_simple->move(public_path() . "/audio/", $audio);
        // Video Upload
        $video_simple = $request->file('video_simple');
        $filename = $video_simple->getClientOriginalName();
        $video = explode('.', $filename);
        $video = $random . '.' . $video_simple->extension();
        $video_file = $video_simple->move(public_path() . "/video/", $video);

        $book = new Book();
        $book->provider_id = auth()->user()->provider->id;
        $book->title = $request->title;
        $book->link = $request->link;
        $book->description = $request->description;
        $book->publisher = $request->publisher;
        $book->cover_path = "/cover/" . $cover;
        $book->release_year = $request->release_year;
        $book->pages_count = $request->pages_count;
        $book->audio_simple = "/audio/" . $audio;
        $book->video_simple = "/video/" . $video;
        if ($book->save()) {
            return redirect()->back();
        }
    }

    public function showBookServices(Request $request)
    {
        $book = Book::find($request->book_id);
        return view('parts.book_services', compact('book'));

    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return Response
     */
    public function show(Book $book)
    {
        return view('website.provider.show_book', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Book $book
     * @return Response
     */
    public function edit(Book $book)
    {
        return view('website.provider.edit_book', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Book $book
     * @return Response
     */
    public function update(Request $request, Book $book)
    {
        $random = Str::random(40);
        //Cover Upload
        if ($request->has('cover_path')) {
            $cover_path = $request->file('cover_path');
            $filename = $cover_path->getClientOriginalName();
            $cover = explode('.', $filename);
            $cover = $random . '.' . $cover_path->extension();
            $cover_file = $cover_path->move(public_path() . "/cover/", $cover);
            $book->cover_path = "/cover/" . $cover;
        }
        // Audio Upload
        if ($request->has('audio_simple')) {
            $audio_simple = $request->file('audio_simple');
            $filename = $audio_simple->getClientOriginalName();
            $audio = explode('.', $filename);
            $audio = $random . '.' . $audio_simple->extension();
            $audio_file = $audio_simple->move(public_path() . "/audio/", $audio);
            $book->audio_simple = "/audio/" . $audio;

        }
        // Video Upload
        if ($request->has('video_simple')) {
            $video_simple = $request->file('video_simple');
            $filename = $video_simple->getClientOriginalName();
            $video = explode('.', $filename);
            $video = $random . '.' . $video_simple->extension();
            $video_file = $video_simple->move(public_path() . "/video/", $video);
            $book->video_simple = "/video/" . $video;

        }


        $book->title = $request->title;
        $book->link = $request->link;
        $book->description = $request->description;
        $book->publisher = $request->publisher;
        $book->release_year = $request->release_year;
        $book->pages_count = $request->pages_count;

        if ($book->save()) {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
