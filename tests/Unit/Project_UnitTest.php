<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

//use PHPUnit\Framework\TestCase;

class Project_UnitTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_has_a_path()
    {

        $project = Project::factory()->create();

        $this->assertEquals('/project/' . $project->id, $project->path());
    }

    public function test_it_belogns_to_user()
    {
        $project = Project::factory()->create();

        $this->assertInstanceOf(User::class, $project->user);
    }

    public function test_it_can_add_a_task()
    {
        $project = Project::factory()->create();

        $task = $project->addTask('test Task');

        $this->assertCount(1, $project->tasks);

        $this->assertTrue($project->tasks->contains($task));
    }
}
