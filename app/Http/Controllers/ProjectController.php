<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;
        return view('project.index', compact('projects'));
    }

    public function store()
    {
        $attributes = \request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => 'min:3'
        ]);

        //$attributes['user_id'] = auth()->id();

        $project = auth()->user()->projects()->create($attributes);

        //Project::query()->create($attributes);

        return redirect($project->path());
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);

        return view('project.show', compact('project'));
    }

    public function create()
    {
        return view('project.create');
    }

    public function update(Project $project)
    {

        $this->authorize('update', $project);

        $project->update(\request(['notes']));

        return redirect($project->path());

    }
}
