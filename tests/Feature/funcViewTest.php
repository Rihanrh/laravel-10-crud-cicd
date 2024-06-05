<?php

namespace Tests\Feature;

use App\Models\Product; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class funcViewTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the show method.
     */
    public function test_show_product(): void
    {
        $product = Product::create([
            'code' => 'H001',
            'name' => 'Kaveh',
            'quantity' => 1,
            'price' => 99.99,
            'description' => 'Husbunya Ren',
        ]);

        $response = $this->get(route('products.show', $product->id));

        $response->assertStatus(200);
        $response->assertViewIs('products.show');
        $response->assertViewHas('product', $product);
    }
}
