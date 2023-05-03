<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TranslatorCollection;
use App\Http\Resources\TranslatorResource;
use App\Models\Translator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Translators management
 *
 * APIs for managing translators
 */

class TranslatorController extends Controller
{
    /**
     * Display a listing of the translators.
     */
    public function index()
    {
        return new TranslatorCollection(Translator::all());
    }

    /**
     * Store a newly created translator in storage.
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'slug' => 'required|unique:translators',
            'name' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors());
        } else {
            $newTranslator = Translator::create($request->all());
            return response()->json('Translator ' . $newTranslator->name . ' Created Successfuly', 200);
        }
    }

    /**
     * Display the specified translator.
     */
    public function show(Translator $translator)
    {
        return new TranslatorResource($translator);
    }

    /**
     * Update the specified translator in storage.
     */
    public function update(Request $request, Translator $translator)
    {
        $validatedData = Validator::make($request->all(), [
            'slug' => 'required|unique:translators,slug,' . $translator->slug . ',slug',
            'name' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors());
        } else {
            $translator->update($request->all());
            return response()->json('Translator ' . $translator->name . ' Updated Successfuly', 200);
        }
    }

    /**
     * Remove the specified translator from storage.
     */
    public function destroy(Translator $translator)
    {
        $translator->delete();
        return response()->json('Trnaslator ' . $translator->name . ' Deleted Successfuly.');
    }
}
