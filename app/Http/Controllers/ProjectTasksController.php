<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
        $this->authorize('create', $project);

        \request()->validate([
            'body' => 'required'
        ]);

        $project->addTask(\request('body'));

        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {

        $this->authorize('update', $project);

        $attributes = \request()->validate([
            'body' => 'required'
        ]);

        $task->update($attributes);

        $method = \request('completed') ? 'complete' : 'incomplete' ;

        $task->$method(); // call complete() | incomplete() method


        return redirect($project->path());
    }
}
