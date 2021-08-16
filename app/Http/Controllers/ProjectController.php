<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;
        return view('project.index', compact('projects'));
    }


    public function create()
    {
        return view('project.create');
    }


    public function show(Project $project)
    {
        $this->authorize('view', $project);

        return view('project.show', compact('project'));
    }

    public function store()
    {
        $attributes = \request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => 'nullable'
        ]);

        //$attributes['user_id'] = auth()->id();

        $project = auth()->user()->projects()->create($attributes);

        //Project::query()->create($attributes);

        return redirect($project->path());
    }


    public function edit(Project $project)
    {

        return view('project.edit', compact('project'));
    }


    public function update(UpdateProjectRequest $request , Project $project)
    {
        //$this->authorize('update', $project);



       /* $attributes = \request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'notes' => 'nullable'
        ]);*/



        $project->update($request->validated());

        return redirect($project->path());

    }


}
