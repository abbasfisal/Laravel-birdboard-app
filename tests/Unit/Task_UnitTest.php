<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Task_UnitTest extends TestCase
{

    use RefreshDatabase ;

    public function test_it_belognsTo_a_project()
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(Project::class , $task->project);
    }

    public function test_it_has_path()
    {
        $this->withoutExceptionHandling();

        $task = Task::factory()->create();

        $str_path ='project/'.$task->project->id.'/tasks/'.$task->id ;

        $this->assertEquals($str_path , $task->path());
    }

    public function test_it_can_completed()
    {
        $task =Task::factory()->create();

        $this->assertFalse($task->completed);

        $task->complete();

        $this->assertTrue($task->completed);
    }

    public function test_it_can_be_marked_incomplete()
    {
        $task = Task::factory()->create(['completed'=>true]);

        $this->assertTrue($task->completed);

        $task->incomplete();

        $this->assertFalse($task->completed);

    }

}
