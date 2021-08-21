<?php

namespace App\Observers;

use App\Models\Project;

class ProjectObserver
{

    public function created(Project $project)
    {
        $project->recordActivity('created' );

    }

    public function updating(Project $project)
    {

        $project->old = $project->getOriginal();

    }

    public function updated(Project $project)
    {

        $project->recordActivity('updated' );

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


}
