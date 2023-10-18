<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Jobs;

class ApiTest extends TestCase
{
    use RefreshDatabase; // Optionally refresh the database before each test
    
    
    public function test_can_get_user_end_point()
    {
        // Arrange
        $job = Jobs::factory()->create();
        // Act
        $response = $this->get('/api/jobs/' . $job->id);
        // Assert
        $response->assertStatus(200)
        ->assertJsonStructure(['id', 'title', 'description', 'salary', 'company', 'postedAt']);
    }
    public function test_can_create_a_job()
    {
        $data = [
            'title' => '"Senior PHP Developer"',
            'description' => '"Google needs a senior developer experienced in PHP, and Laravel."',
            'salary' => '40000',
            'company' => '"Google"',
            'postedAt' => now()->format('Y-m-d')
        ];
        $response = $this->post('/api/jobs', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('jobs', [
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
    }

    public function test_can_update_a_job()
    {
        $job = Jobs::factory()->create();
        $newData = [
            'title' => '"Senior PHP Developer v2"',
            'description' => '"Google needs a senior developer experienced in PHP, and Laravel."',
            'salary' => '40000',
            'company' => '"Google"',
            'postedAt' => now()->format('Y-m-d')
        ];
        $response = $this->put('/api/jobs/' . $job->id, $newData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('jobs', [
            'id' => $job->id,
            'title' => $newData['title'],
            'description' => $newData['description'],
        ]);
    }

    public function test_can_delete_a_job()
    {
        $job = Jobs::factory()->create();
        $response = $this->delete('/api/jobs/' . $job->id);
        $response->assertStatus(204);
        $this->assertDatabaseMissing('jobs', [ 'id' => $job->id ]);
    }
}



