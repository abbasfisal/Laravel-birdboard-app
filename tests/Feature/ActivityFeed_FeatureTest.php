<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityFeed_FeatureTest extends TestCase
{
    use RefreshDatabase;


    public function test_creating_a_project_generate_activity()
    {
        $project  = Project::factory()->create();

        $this->assertCount(1 , $project->activity);
        $this->assertEquals('created' , $project->activity[0]->description);
    }

    public function test_updating_project_generate_activity()
    {
    //$this->withoutExceptionHandling();
        $project = Project::factory()->create();

        $project->update(['title'=>'changed']);

        $this->assertCount(2 , $project->activity);

        //$this->assertEquals('updated',$project->activity[1]->description);

    }
}
