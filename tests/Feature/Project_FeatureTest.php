<?php

namespace Tests\Feature;

use App\Models\Project;
use Facades\Setup\ProjectFactory_Setup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Project_FeatureTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    public function test_guest_can_not_manage_project()
    {

        $project = Project::factory()->create();

        $this->get('/project')->assertRedirect('login');

        $this->get($project->path())->assertRedirect('login');

        $this->get($project->path() . '/edit')->assertRedirect('login');

        $this->post('/project', $project->toArray())
            ->assertRedirect('login');

    }


    /** @test */
    public function a_user_can_create_a_project()
    {

        $this->withoutExceptionHandling();

        $this->signIn();

        $data = [
            'title' => $this->faker->title,
            'description' => $this->faker->paragraph,
            'notes' => 'genral notes'
        ];

        $this->post('/project', $data);

        $this->assertDatabaseHas(Project::class, $data);

    }

    public function test_a_user_can_update_a_project()
    {
        // $this->withoutExceptionHandling();


        $project = ProjectFactory_Setup::ownedBy($this->signIn())->create();


        $this->patch($project->path(), $attributes = ['notes' => 'changed', 'description' => 'chnaged', 'title' => 'changed'])
            ->assertRedirect($project->path());

        $this->get($project->path() . '/edit')->assertOk();

        $this->assertDatabaseHas(Project::class, $attributes);
    }

    public function test_a_user_can_update_a_projects_general_notes()
    {

        $this->withExceptionHandling();

        $project = ProjectFactory_Setup::ownedBy($this->signIn())->create();

        $this->patch($project->path(),
            $attributes = ['notes' => 'changed']);

        $this->assertDatabaseHas(Project::class, $attributes);

    }

    /** @test */
    public function a_project_require_a_title()
    {

        //$this->actingAs(User::factory()->create()); ===>$this->>signIn()
        $this->signIn();

        $attribute = Project::factory()->raw(['title' => '']);

        $this->post('/project', $attribute)->assertSessionHasErrors('title');
    }

    public function test_a_project_required_a_description()
    {
        $this->signIn();

        $this->post('/project', [])->assertSessionHasErrors('description');
    }


    public function test_a_user_can_view_their_project()
    {

        $project = ProjectFactory_Setup::ownedBy($this->signIn())->create();


        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_an_authenticated_user_can_not_view_the_project_of_others()
    {
        $this->signIn();

        $project = ProjectFactory_Setup::create();

        $this->get($project->path())
            ->assertStatus(403);

    }

    public function test_an_authenticated_user_can_not_update_the_project_of_others()
    {
        $this->signIn();

        $project = ProjectFactory_Setup::ownedBy()->create();

        $this->patch($project->path(), ['notes' => 'changed'])
            ->assertStatus(403);

    }
}


