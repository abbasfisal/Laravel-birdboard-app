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


}


