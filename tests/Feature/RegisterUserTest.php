<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_user()
    {
        // register a user
        $response = $this->post('/api/register', [
            'email' => 'backend@multisyscorp.com',
            'password' => 'test123'
        ]);

        //response when success
        $response->assertStatus(201);

        //check if it is stored in the db
        $this->assertDatabaseHas('users', [
            'email' => 'backend@multisyscorp.com',
        ]);
    }

    public function test_register_already_exist_user()
    {
        //register a user
        $response = $this->post('/api/register', [
            'email' => 'backend@multisyscorp.com',
            'password' => 'test123'
        ]);
        //response when success
        $response->assertStatus(201);

        //retry to register
        $response = $this->post('/api/register', [
            'email' => 'backend@multisyscorp.com',
            'password' => 'test123'
        ]);
        //response when failed
        $response->assertStatus(400);
    }
}
