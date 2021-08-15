<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
        $this->authorize('create',$project);

        \request()->validate([
            'body'=>'required'
        ]);

         $project->addTask(\request('body'));

        return redirect($project->path() );
    }

    public function update(Project $project, Task $task)
    {

        $this->authorize('update',$project);

        $task->update([
            'body'=>\request()->get('body'),
            'completed'=>\request()->has('completed')
        ]);

        return redirect($project->path());
    }
}
