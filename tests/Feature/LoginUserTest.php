<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_valid_user_credential()
    {
        $response = $this->post('/api/login', [
            'email' => 'backend@multisyscorp.com',
            'password' => 'test123'
        ]);
        $response->assertStatus(201);
    }

    public function test_login_invalid_user_credential()
    {
        $response = $this->post('/api/login', [
            'email' => 'backend@multisyscorp.com',
            'password' => 'test12'
        ]);
        $response->assertStatus(401);
    }

    public function test_login_account_locking()
    {
        $response = '';
        for ($i=0; $i < 6; $i++) {
            $response = $this->post('/api/login', [
                'email' => 'backend@multisyscorp.com',
                'password' => 'test12'
            ]);
        }

        $response->assertStatus(429);
    }
}
