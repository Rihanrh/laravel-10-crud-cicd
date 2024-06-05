<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class funcCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the create function.
     *
     * @return void
     */
    public function test_create_products()
    {
        $response = $this->get(route('products.create'));

        $response->assertStatus(200);

        $response->assertViewIs('products.create');
    }
}
