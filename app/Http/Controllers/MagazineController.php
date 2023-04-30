<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MagazineController extends Controller
{
    /**
     * Display a listing of the magazine.
     */
    public function index()
    {
        $magazines = Magazine::all();
        return Inertia::render('MagazinesView', [
            'magazines' => $magazines,
        ]);
    }

    /**
     * Store a newly created magazine in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified magazine.
     *
     * @param  \App\Models\Magazine $magazine
     */
    public function show(Magazine $magazine)
    {
    }

    /**
     * Update the specified magazine in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Magazine $magazine
     */
    public function update(Request $request, Magazine $magazine)
    {
    }

    /**
     * Remove the specified magazine from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function destroy(Request $request)
    {
    }
}
