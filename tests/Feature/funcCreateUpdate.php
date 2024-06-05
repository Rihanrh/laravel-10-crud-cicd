<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class funcCreateUpdate extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test the update function.
     *
     * @return void
     */
    public function test_update_products()
    {
        $response = $this->get(route('products.create'));

        $response->assertStatus(200);

        $response->assertViewIs('products.create');
    }
}
