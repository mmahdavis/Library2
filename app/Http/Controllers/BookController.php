<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $books = Book::all();
        return Inertia::render('BooksView', [
            'books' => Book::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book $book
     */
    public function destroy(Object $book)
    {
        // foreach ($book as $item) {
        //     $items = Book::find($item);
        $item = $book[0];
        return response()->json('item deleted ' . $item, 200);
        // }
        // try {
        //     foreach ($book as $item) {
        //         return response()->json('item deleted ' . $item, 300);
        //     }
        //     // $book->delete();
        //     // return response()->json('deleted', 200);
        // } catch (\Throwable $th) {
        //     return response()->json($th);
        // }

    }
}
