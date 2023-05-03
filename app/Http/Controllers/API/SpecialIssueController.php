<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpecialIssueCollection;
use App\Http\Resources\SpecialIssueResource;
use App\Models\SpecialIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Special Issue management
 *
 * APIs for managing special Issues
 */

class SpecialIssueController extends Controller
{
    /**
     * Display a listing of the special issues.
     */
    public function index()
    {
        return new SpecialIssueCollection(SpecialIssue::all());
    }

    /**
     * Store a newly created special issue in storage.
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'slug' => 'required|unique:special_issues',
            'name' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors());
        } else {
            $newSpecialIssue = SpecialIssue::create($request->all());
            return response()->json('special issue ' . $newSpecialIssue->name . ' Created Successfuly', 200);
        }
    }

    /**
     * Display the specified special issue.
     */
    public function show(SpecialIssue $specialIssue)
    {
        return new SpecialIssueResource($specialIssue);
    }

    /**
     * Update the specified special issue in storage.
     */
    public function update(Request $request, SpecialIssue $specialIssue)
    {
        $validatedData = Validator::make($request->all(), [
            'slug' => 'required|unique:special_issues,slug,' . $specialIssue->slug . ',slug',
            'name' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors());
        } else {
            $specialIssue->update($request->all());
            return response()->json('special issue ' . $specialIssue->name . ' Updated Successfuly', 200);
        }
    }

    /**
     * Remove the specified special issue from storage.
     */
    public function destroy(SpecialIssue $specialIssue)
    {
        $specialIssue->delete();
        return response()->json('Special Issue ' . $specialIssue->name . ' Deleted Successfuly.', 200);
    }
}
