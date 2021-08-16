<?php


namespace Setup;


use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class ProjectFactory_Setup
{
    private $TaskCount =0;
    private $user;

    public function withTasks($TaskCount)
    {
        $this->TaskCount = $TaskCount;
        return $this;
    }

    public function ownedBy( $user = null)
    {
        $this->user = $user;
        return $this;
    }

    public function create()
    {

        $project = Project::factory()->create([
            'user_id' => $this->user ?? User::factory()
        ]);

        $task =Task::factory()->count($this->TaskCount)->create([
            'project_id'=>$project->id
        ]);

        return $project ;

    }
}




