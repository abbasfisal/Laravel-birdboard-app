<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    public function test_only_authenticated_user_can_create_project()
    {

        //$this->withoutExceptionHandling();
        //اگر پروژه یک صاب نداش خطا بده

        //$attributes = Project::factory()->raw(['user_id'=>null]);


        $attributes = Project::factory()->raw();

        $this->post('/project', $attributes)
            ->assertRedirect('login');

    }

    /** @test */
    public function a_user_can_create_a_project()
    {

        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());


        $data = [

            'title' => $this->faker->title,
            'description' => $this->faker->paragraph
        ];

        $this->post('/project', $data)->assertRedirect('/project');

        $this->assertDatabaseHas(Project::class, $data);

        $this->get('/project')->assertSee($data['title']);
    }


    /** @test */
    public function a_project_require_a_title()
    {

        $this->actingAs(User::factory()->create());

        $attribute = Project::factory()->raw(['title' => '']);

        $this->post('/project', $attribute)->assertSessionHasErrors('title');
    }

    public function test_a_project_required_a_description()
    {
        $this->actingAs(User::factory()->create());

        $this->post('/project', [])->assertSessionHasErrors('description');
    }


    public function test_a_user_can_view_a_project()
    {
        //create project in db then catch it from db
        //go to view and see those data

        $this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }


}


