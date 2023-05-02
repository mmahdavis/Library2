<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AudiosController extends Controller
{
    /**
     * Display a listing of the image.
     */
    public function index()
    {
        $audios = Storage::disk('local')->allFiles('public/audios');
        foreach ($audios as $key => $value) {
            $audiosUrl[$key] = Storage::url($value);
        }

        return Inertia::render('AudiosView', [
            'audiosUrl' => $audiosUrl,
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
