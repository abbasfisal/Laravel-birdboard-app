<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Project;

class ProjectObserver
{

    public function created(Project $project)
    {
        $this->recordActivity('created' , $project);

    }


    public function updated(Project $project)
    {
        $this->recordActivity('updated' , $project);

    }

    /**
     * Handle the Project "deleted" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function deleted(Project $project)
    {
        //
    }

    /**
     * Handle the Project "restored" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function restored(Project $project)
    {
        //
    }

    public function forceDeleted(Project $project)
    {
        //
    }

    public function recordActivity($type , $project)
    {
        Activity::query()->create([
            'project_id'=>$project->id ,
            'description'=>$type
        ]);
    }
}
