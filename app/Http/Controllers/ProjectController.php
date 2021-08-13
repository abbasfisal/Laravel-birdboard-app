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


        $attributes = \request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        //$attributes['user_id'] = auth()->id();

        auth()->user()->projects()->create($attributes);

        //Project::query()->create($attributes);

        return redirect('/project');
    }

    public function show(Project $project)
    {

        //$project = Project::find($id);

        return view('project.show', compact('project'));


    }
}
