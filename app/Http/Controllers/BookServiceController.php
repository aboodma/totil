<?php

namespace App\Http\Controllers;

use App\BookService;
use App\BookServiceFile;
use App\Book;
use App\Service;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BookServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Book $book)
    {
        $services = Service::all();
        return view('website.provider.add_book_service', compact('book', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Book $book, Request $request)
    {
        $bookService = new BookService();
        $bookService->book_id = $book->id;
        $bookService->service_id = $request->service_id;
        $bookService->price = $request->price;
        $bookService->file_path = "No File";
        if ($bookService->save()) {
            foreach ($request->file('file') as $file) {
                $random = Str::random(40);
                $filename = $file->getClientOriginalName();
                $add_file = explode('.', $filename);
                $add_file = $random . '.' . $file->extension();
                $service_file = $file->move(public_path() . "/service/files/", $add_file);
                $serviceFile = new BookServiceFile();
                $serviceFile->book_service_id = $bookService->id;
                $serviceFile->file_path = "/service/files/" . $add_file;
                $serviceFile->save();
            }
            return redirect()->route('provider.books.service.show', $book->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param BookService $bookService
     * @return Response
     */
    public function show(BookService $bookService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BookService $bookService
     * @return Response
     */
    public function edit(BookService $bookService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param BookService $bookService
     * @return Response
     */
    public function update(Request $request, BookService $bookService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BookService $bookService
     * @return Response
     */
    public function destroy(BookService $bookService)
    {
        foreach ($bookService->files as $file) {
            $file->delete();
        }
        $bookService->delete();
        return redirect()->back();
    }
}
