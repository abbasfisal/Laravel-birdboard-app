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
}
