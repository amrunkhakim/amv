<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects()->orderBy('created_at', 'desc')->get();
        return view('portal.projects.index', compact('projects'));
    }

    public function show(\App\Models\Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }
        return view('portal.projects.show', compact('project'));
    }
}
