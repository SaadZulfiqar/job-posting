<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jobs;

class JobsController extends Controller
{
    public function index()
    {
        $jobs = Jobs::all();
        return response()->json($jobs);
    }

    public function store(Request $request)
    {
        $job = Jobs::create($request->all());
        return response()->json($job, 201);
    }

    public function show($id)
    {
        $job = Jobs::find($id);
        return response()->json($job);
    }

    public function update(Request $request, $id)
    {
        $job = Jobs::find($id);
        $job->update($request->all());
        return response()->json($job);
    }

    public function destroy($id)
    {
        $job = Jobs::find($id);
        $job->delete();
        return response()->json(null, 204);
    }
}

