<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MagazineCollection;
use App\Http\Resources\MagazineResource;
use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MagazineController extends Controller
{
    /**
     * Display a listing of the magazine.
     */
    public function index()
    {
        return new MagazineCollection(Magazine::all());
    }

    /**
     * Store a newly created magazine in storage.
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'slug' => 'required|unique:magazines',
            'name' => 'required',
            'price' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors());
        } else {
            $newMagazine = Magazine::create($request->all());
            return response()->json('magazine ' . $newMagazine->name . ' Created Successfuly', 200);
        }
    }

    /**
     * Display the specified magazine.
     */
    public function show(Magazine $magazine)
    {
        return new MagazineResource($magazine);
    }

    /**
     * Update the specified magazine in storage.
     */
    public function update(Request $request, Magazine $magazine)
    {
        $validatedData = Validator::make($request->all(), [
            'slug' => 'required|unique:magazines,slug,' . $magazine->slug . ',slug',
            'name' => 'required',
            'price' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors());
        } else {
            $magazine->update($request->all());
            return response()->json('magazine ' . $magazine->name . ' Updated Successfuly', 200);
        }
    }

    /**
     * Remove the specified magazine from storage.
     */
    public function destroy(Magazine $magazine)
    {
        $magazine->delete();
        return response()->json('Magazine ' . $magazine->name . ' Deleted Successfuly', 200);
    }
}
