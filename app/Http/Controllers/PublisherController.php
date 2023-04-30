<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublisherController extends Controller
{
    /**
     * Display a listing of the publisher.
     */
    public function index()
    {
        $publishers = Publisher::all();
        return Inertia::render('PublishersView', [
            'publishers' => $publishers,
        ]);
    }

    /**
     * Store a newly created publisher in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified publisher.
     *
     * @param  \App\Models\Publisher $publisher
     */
    public function show(Publisher $publisher)
    {
    }

    /**
     * Update the specified publisher in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publisher $publisher
     */
    public function update(Request $request, Publisher $publisher)
    {
    }

    /**
     * Remove the specified publisher from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function destroy(Request $request)
    {
    }
}
