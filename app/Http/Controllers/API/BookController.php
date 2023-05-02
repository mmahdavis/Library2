<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

/**
 * @group Books management
 *
 * APIs for managing books
 */

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index()
    {
        return new BookCollection(Book::all());
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified book.
     * @urlParam id integer required The ID of the book.
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
