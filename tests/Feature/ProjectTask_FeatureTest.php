<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Facades\Setup\ProjectFactory_Setup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTask_FeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_project_can_have_tasks()
    {
        // $this->withoutExceptionHandling();

        $project = ProjectFactory_Setup::ownedBy($this->signIn())->create();

        $this->post($project->path() . '/tasks', ['body' => 'test Task']);

        $this->get($project->path())->assertSee('test Task');
    }

    public function test_task_can_be_updated()
    {

        $project =
            ProjectFactory_Setup::
            ownedBy($this->signIn())
                ->withTasks(1)
                ->create();

        $data = [
            'body' => 'changed'
        ];

        $this->patch($project->tasks()->first()->path(), $data);
        $this->assertDatabaseHas(Task::class, $data);
    }

    public function test_a_task_can_be_completed()
    {
        $project = ProjectFactory_Setup::ownedBy($this->signIn())->withTasks(1)->create();

        $data = [
            'body' => 'changed',
            'completed' => true
        ];

        $this->patch($project->tasks()->first()->path(), $data);


        $this->assertDatabaseHas(Task::class , $data);

    }

    public function test_a_task_can_be_marked_incomplete()
    {
        $project = ProjectFactory_Setup::ownedBy($this->signIn())->withTasks(1)->create();

        $data = [
            'body' => 'changed',
            'completed' => false
        ];

        $this->patch($project->tasks()->first()->path(), $data);


        $this->assertDatabaseHas(Task::class , $data);

    }

    public function test_a_task_require_a_body()
    {
        $this->signIn();

        $project = auth()->user()
            ->projects()->create(Project::factory()->raw());

        $attribute = Task::factory()->raw([
            'body' => '',
            'project_id' => $project->id
        ]);

        $this->post($project->path() . '/tasks', $attribute)
            ->assertSessionHasErrors('body');

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

        $project =
            ProjectFactory_Setup::withTasks(1)
                ->create();

        $this->actingAs($this->signIn())
            ->patch($project->tasks()->first()->path(), [
                'body' => 'changed'
            ])->assertStatus(403);
    }
}
