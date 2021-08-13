<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('project.index', compact('projects'));
    }

    public function store()
    {

        $attributes = \request()->validate(['title' => 'required', 'description' => 'required']);

        Project::query()->create($attributes);

        return redirect('/project');
    }
}
