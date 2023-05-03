<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublisherCollection;
use App\Http\Resources\PublisherResource;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Publishers management
 *
 * APIs for managing publisher
 */

class PublisherController extends Controller
{
    /**
     * Display a listing of the publishers.
     */
    public function index()
    {
        return new PublisherCollection(Publisher::all());
    }

    /**
     * Store a newly created publisher in storage.
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'slug' => 'required|unique:publishers',
            'name' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors());
        } else {
            $newPublisher = Publisher::create($request->all());
            return response()->json('publisher ' . $newPublisher->name . ' Created Successfuly', 200);
        }
    }

    /**
     * Display the specified publisher.
     */
    public function show(Publisher $publisher)
    {
        return new PublisherResource($publisher);
    }

    /**
     * Update the specified publisher in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $validatedData = Validator::make($request->all(), [
            'slug' => 'required|unique:publishers,slug,' . $publisher->slug . ',slug',
            'name' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors());
        } else {
            $publisher->update($request->all());
            return response()->json('publisher ' . $publisher->name . ' Updated Successfuly', 200);
        }
    }

    /**
     * Remove the specified publisher from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return response()->json('Publisher ' . $publisher->name . ' Deleted Successfuly');
    }
}
