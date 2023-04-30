<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Tag;
use App\Models\Tagrelations;
use App\Models\Translator;
use App\Models\Writer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the book.
     */
    public function index()
    {
        $books = Book::with('category', 'writer', 'publisher', 'translator')->get([
            '*',
            'category_id as category',
        ]);
        foreach ($books as $item) {
            $item->writer->makeHidden('image', 'slug', 'created_at', 'updated_at');
            $item->publisher->makeHidden('image', 'slug', 'created_at', 'updated_at');
            $item->translator->makeHidden('image', 'slug', 'created_at', 'updated_at');
        }
        return Inertia::render('BooksView', [
            'books' => $books,
            'categories' =>Category::all('id', 'name'),
            'tags' => Tag::all('id', 'name'),
            'writers' => Writer::all('id', 'name'),
            'publishers' => Publisher::all('id', 'name'),
            'translators' => Translator::all('id', 'name'),
        ]);
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        try {
            $book = Book::create([
                'category_id' => $request->category,
                'writer_id' => $request->writer,
                'publisher_id' => $request->publisher,
                'translator_id' => $request->translator,
                'code' => 11223355,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'inventoryStatus' => $request->inventoryStatus,
            ]);
            foreach ($request->tag as $item) {
                Tagrelations::create([
                    'entity_id' => $book->id,
                    'tag_id' => $item,
                ]);
            }
            return response()->json($book, 200);
        } catch (\Throwable $th) {
            return response()->json($th);
        }

    }

    /**
     * Display the specified book.
     *
     * @param  \App\Models\Book $book
     */
    public function show(Book $book)
    {
    }

    /**
     * Update the specified book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book $book
     */
    public function update(Request $request, Book $book)
    {
        try {
            $book->update([
                'category_id' => $request->category,
                'writer_id' => $request->writer,
                'publisher_id' => $request->publisher,
                'translator_id' => $request->translator,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'inventoryStatus' => $request->inventoryStatus,
            ]);
            if($request->tag){
                Tagrelations::where('entity_id',$book->id)->where('type','book')->delete();
                foreach ($request->tag as $item) {
                    Tagrelations::create([
                        'entity_id' => $book->id,
                        'tag_id' => $item,
                        'type' => 'book',
                    ]);
                }
            }
            return response()->json($book, 200);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function destroy(Request $request)
    {
        try {
            $books = Book::whereIn('id', $request)->delete();
            return response()->json('books deleted', 200);
        } catch (\Throwable $th) {
            return response()->json($th);
        }

    }
}
