<?php

namespace Tests\Feature;

use App\Models\Project;
use Facades\Setup\ProjectFactory_Setup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TriggerActivity_FeatureTest extends TestCase
{
    use RefreshDatabase;


    public function test_creating_a_project()
    {
        $project = Project::factory()->create();

        $this->assertCount(1, $project->activity);
        $this->assertEquals('created', $project->activity[0]->description);
    }

    public function test_updating_project()
    {

        $project = Project::factory()->create();

        $project->update(['title' => 'changed']);

        $this->assertCount(2, $project->activity);

    }

    public function test_creating_a_new_task()
    {
        $project = Project::factory()->create();
        $project->addTask('Some Task');
        $this->assertCount(2, $project->activity);
        $this->assertEquals('created_task', $project->activity->last()->description);
    }

    public function test_completing_a_task()
    {
        $this->withExceptionHandling();
        $project = ProjectFactory_Setup::withTasks(1)->create();
        $this->actingAs($project->user)->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => true
        ]);

        $this->assertCount(3, $project->activity);
    }

    public function test_incompleting_a_task()
    {
        $this->withExceptionHandling();

        $project = ProjectFactory_Setup::ownedBy($this->signIn())
            ->withTasks(1)
            ->create();


        $this->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => true
        ]);

        $this->assertCount(3, $project->activity);


        $this->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => false
        ]);

        $project->refresh();
        $this->assertCount(4, $project->activity);
        $this->assertEquals('uncompleted_task',
            $project->activity->last()->description);
    }

    public function test_deleting_a_task()
    {
        $proejct  = ProjectFactory_Setup::withTasks(1)->create();

        $proejct->tasks[0]->delete();

        $this->assertCount(3 , $proejct->activity);
    }
}
