<?php

namespace Tests\Feature;

use App\Models\Product; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class funcDeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the destroy method.
     */
    public function test_delete_product(): void
    {
        // Create a product to delete
        $product = Product::create([
            'code' => 'P12345',
            'name' => 'Product to be deleted',
            'quantity' => 10,
            'price' => 99.99,
            'description' => 'Product description',
        ]);

        // Send the delete request
        $response = $this->delete(route('products.destroy', $product->id));

        // Assert the response status
        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('success', 'Product is deleted successfully.');

        // Assert the product was deleted
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
