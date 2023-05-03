<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\WriterCollection;
use App\Http\Resources\WriterResource;
use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return new WriterCollection(Writer::all());
    }

    /**
     * Store a newly created writer in storage.
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'slug' => 'required|unique:writers',
            'name' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors());
        } else {
            $newWriter = Writer::create($request->all());
            return response()->json('Writer ' . $newWriter->name . ' Created Successfuly', 200);
        }
    }

    /**
     * Display the specified writer.
     */
    public function show(Writer $writer)
    {
        return new WriterResource($writer);
    }

    /**
     * Update the specified writer in storage.
     */
    public function update(Request $request, Writer $writer)
    {
        $validatedData = Validator::make($request->all(), [
            'slug' => 'required|unique:writers,slug,'.$writer->slug.',slug',
            'name' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors());
        } else {
            $writer->update($request->all());
            return response()->json('Writer ' . $writer->name . ' Created Successfuly', 200);
        }
    }

    /**
     * Remove the specified writer from storage.
     */
    public function destroy(Writer $writer)
    {
        $writer->delete();
        return response()->json('Writer ' . $writer->name . 'Deleted Successfuly.', 200);
    }
}
