<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_user()
    {
        $response = $this->post('/api/register', [
            'email' => 'backend@multisyscorp.com',
            'password' => 'test123'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'email' => 'backend@multisyscorp.com',
        ]);
    }

    public function test_register_already_exist_user()
    {
        $response = $this->post('/api/register', [
            'email' => 'backend@multisyscorp.com',
            'password' => 'test123'
        ]);

        $response->assertStatus(400);
    }
}
