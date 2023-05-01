<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    /**
     * Display a listing of the image.
     */
    public function index()
    {
        $images = Storage::disk('dropbox')->allFiles('images');
        foreach ($images as $key => $value) {
            $imagesUrl[$key] = Storage::disk('dropbox')->url($value);
        }
        return Inertia::render('ImagesView', [
            'imagesUrl' => $imagesUrl,
        ]);
    }

    /**
     * Store a newly created image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified image.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function show(Request $request)
    {
    }

    /**
     * Update the specified image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified image from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function destroy(Request $request)
    {
    }
}
