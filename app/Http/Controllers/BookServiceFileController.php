<?php

namespace App\Http\Controllers;

use App\BookServiceFile;
use App\BookService;
use Illuminate\Http\Request;

class BookServiceFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BookService $bookService)
    {
        $files =  $bookService->files;
        $book = $bookService->book;
        return view('website.provider.show_book_service_files',compact('files','book'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookServiceFile  $bookServiceFile
     * @return \Illuminate\Http\Response
     */
    public function show(BookServiceFile $bookServiceFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookServiceFile  $bookServiceFile
     * @return \Illuminate\Http\Response
     */
    public function edit(BookServiceFile $bookServiceFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookServiceFile  $bookServiceFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookServiceFile $bookServiceFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookServiceFile  $bookServiceFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookServiceFile $bookServiceFile)
    {
        //
    }
}
