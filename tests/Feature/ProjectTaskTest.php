<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_project_can_have_tasks()
    {
       // $this->withoutExceptionHandling();

        $this->signIn();

        $project = Project::factory()->create(['user_id'=>auth()->id()]);

        $this->post($project->path().'/tasks' , ['body'=>'test Task']);

        $this->get($project->path())->assertSee('test Task');
    }

    public function test_a_task_require_a_body()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(Project::factory()->raw());

        $attribute = Task::factory()->raw(['body'=>'']);

        $this->post($project->path().'/tasks' , $attribute)->assertSessionHasErrors('body');
        

    }
}
