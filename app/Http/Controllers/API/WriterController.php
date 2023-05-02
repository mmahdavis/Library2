<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Writer;
use Illuminate\Http\Request;

/**
 * @group Writers management
 *
 * APIs for managing Writers
 */

class WriterController extends Controller
{
    /**
     * Display a listing of the writers.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created writer in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified writer.
     */
    public function show(Writer $writer)
    {
        //
    }

    /**
     * Update the specified writer in storage.
     */
    public function update(Request $request, Writer $writer)
    {
        //
    }

    /**
     * Remove the specified writer from storage.
     */
    public function destroy(Writer $writer)
    {
        //
    }
}
