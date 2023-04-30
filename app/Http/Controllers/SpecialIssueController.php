<?php

namespace App\Http\Controllers;

use App\Models\SpecialIssue;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SpecialIssueController extends Controller
{
    /**
     * Display a listing of the special_issue.
     */
    public function index()
    {
        $special_issues = SpecialIssue::all();
        return Inertia::render('SpecialIssuesView', [
            'special_issues' => $special_issues,
        ]);
    }

    /**
     * Store a newly created special_issue in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified special_issue.
     *
     * @param  \App\Models\SpecialIssue $special_issue
     */
    public function show(SpecialIssue $special_issue)
    {
    }

    /**
     * Update the specified special_issue in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SpecialIssue $special_issue
     */
    public function update(Request $request, SpecialIssue $special_issue)
    {
    }

    /**
     * Remove the specified special_issue from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function destroy(Request $request)
    {
    }
}
