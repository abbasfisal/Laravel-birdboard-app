<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTask_FeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_project_can_have_tasks()
    {
        // $this->withoutExceptionHandling();

        $this->signIn();

        $project = Project::factory()->create(['user_id' => auth()->id()]);

        $this->post($project->path() . '/tasks', ['body' => 'test Task']);

        $this->get($project->path())->assertSee('test Task');
    }

    public function test_a_project_can_update_task()
    {
        //$this->withoutExceptionHandling();
        $this->signIn();

        $project = Project::factory()->create(['user_id' => auth()->id()]);

        $task = $project->addTask('test Task');

        $this->patch($task->path(), [
            'body' => 'changed',
            'completed' => true
        ]);
        $this->assertDatabaseHas(Task::class , [
            'body'=>'changed' ,
            'completed'=>true
        ]);
    }

    public function test_a_task_require_a_body()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(Project::factory()->raw());

        $attribute = Task::factory()->raw(['body' => '', 'project_id' => $project->id]);

        $this->post($project->path() . '/tasks', $attribute)->assertSessionHasErrors('body');

    }

    public function test_only_owner_of_project_can_add_tasks()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks', ['body' => 'test Task3'])
            ->assertSee(403);

        $this->assertDatabaseMissing(Task::class, ['body' => 'test Task3']);

    }

    public function test_only_owner_of_project_can_update_tasks()
    {
        //$this->withoutExceptionHandling();
        $this->signIn();

        $project = Project::factory()->create();
        $task =$project->addTask('test Task');

        $this->patch($task->path(),[
            'body'=>'changed'

        ])->assertStatus(403);
    }
}