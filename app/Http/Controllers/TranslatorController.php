<?php

namespace App\Http\Controllers;

use App\Models\Translator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TranslatorController extends Controller
{
    /**
     * Display a listing of the translator.
     */
    public function index()
    {
        $translators = Translator::all();
        return Inertia::render('TranslatorsView', [
            'translators' => $translators,
        ]);
    }

    /**
     * Store a newly created translator in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified translator.
     *
     * @param  \App\Models\Translator $translator
     */
    public function show(Translator $translator)
    {
    }

    /**
     * Update the specified translator in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Translator $translator
     */
    public function update(Request $request, Translator $translator)
    {
    }

    /**
     * Remove the specified translator from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function destroy(Request $request)
    {
    }
}
