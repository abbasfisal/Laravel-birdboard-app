<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('project.index' , compact('projects'));
    }

    public function store()
    {
        //validate

        //persist
        Project::query()->create(request(['title', 'description']));

        //redirect
        return redirect('/project');
    }
}
