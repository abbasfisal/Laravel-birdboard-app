<?php

namespace Tests\Feature;

use App\Models\Project;
use Facades\Setup\ProjectFactory_Setup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityFeed_FeatureTest extends TestCase
{
    use RefreshDatabase;


    public function test_creating_a_project_record_activity()
    {
        $project  = Project::factory()->create();

        $this->assertCount(1 , $project->activity);
        $this->assertEquals('created' , $project->activity[0]->description);
    }

    public function test_updating_project_record_activity()
    {

        $project = Project::factory()->create();

        $project->update(['title'=>'changed']);

        $this->assertCount(2 , $project->activity);

    }

    public function test_creating_a_new_task_records_project_activity()
    {
        $project = Project::factory()->create();
        $project->addTask('Some Task');
        $this->assertCount(2 , $project->activity);
        $this->assertEquals('created_task' , $project->activity->last()->description);
    }

    public function test_completing_a_new_task_record_project_activity()
    {
            $this->withExceptionHandling();
            $project = ProjectFactory_Setup::withTasks(1)->create();
            $this->actingAs($project->user)->patch($project->tasks[0]->path() , [
                'body'=>'foobar',
                'completed'=>true
            ]);

            $this->assertCount(3 , $project->activity);
    }
}
