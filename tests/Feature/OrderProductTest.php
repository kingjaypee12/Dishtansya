<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_place_order_proper_quantity()
    {
        $response = $this->post('/api/login', [
            'email' => 'backend@multisyscorp.com',
            'password' => 'test123'
        ]);

        $response = $this->post('/api/orders', [
            'product_id' => 2,
            'quantity' => 5
        ]);

        $response->assertStatus(201);
    }

    /**
    * A basic feature test example.
    *
    * @return void
    */
    public function test_place_order_invalid_quantity()
    {
        $response = $this->post('/api/login', [
            'email' => 'backend@multisyscorp.com',
            'password' => 'test123'
        ]);

        $response = $this->post('/api/orders', [
            'product_id' => 1,
            'quantity' => 5
        ]);

        $response->assertStatus(400);
    }
}
