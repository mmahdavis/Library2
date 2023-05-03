<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $validatedData = Validator::make($request->all(), [
            'code' => 'required|unique:books|max:8',
            'name' => 'required',
            'price' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors());
        } else {
            $newBook = Book::create($request->all());
            return response()->json('book ' . $newBook->name . ' Created Successfuly', 200);
        }
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
        $validatedData = Validator::make($request->all(), [
            'code' => [
                'required',
                'max:8',
                Rule::unique('books')->ignore($book->code, 'code'),
            ],
            'name' => 'required',
            'price' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors());
        } else {
            $book->update($request->all());
            return response()->json('book ' . $book->name . ' Updated Successfuly', 200);
        }
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json('book ' . $book->id . ' Deleted', 200);
    }
}
