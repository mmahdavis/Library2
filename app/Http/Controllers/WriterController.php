<?php

namespace App\Http\Controllers;

use App\Models\Writer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WriterController extends Controller
{
    /**
     * Display a listing of the writer.
     */
    public function index()
    {
        $writers = Writer::all();
        return Inertia::render('WritersView', [
            'writers' => $writers,
        ]);
    }

    /**
     * Store a newly created writer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified writer.
     *
     * @param  \App\Models\Writer $writer
     */
    public function show(Writer $writer)
    {
    }

    /**
     * Update the specified writer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Writer $writer
     */
    public function update(Request $request, Writer $writer)
    {
    }

    /**
     * Remove the specified writer from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function destroy(Request $request)
    {
    }
}
