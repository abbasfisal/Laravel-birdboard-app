<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_project()
    {

        $this->withoutExceptionHandling();


        $data = [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph
        ];

        $this->post('/project', $data)->assertRedirect('/project');

        $this->assertDatabaseHas(Project::class, $data);

        $this->get('/project')->assertSee($data['title']);
    }


   /** @test */
    public function a_project_require_a_title()
    {
        $attribute = Project::factory()->raw(['title'=>'']);

        $this->post('/project',$attribute)->assertSessionHasErrors('title');
    }

    public function test_a_project_required_a_description()
    {
        $this->post('/project' ,[])->assertSessionHasErrors('description');
    }
}


