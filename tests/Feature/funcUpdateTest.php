<?php

namespace Tests\Feature;

use App\Models\Product; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class funcUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the update method.
     */
    public function test_update_product(): void
    {
        $product = Product::create([
            'code' => 'H001',
            'name' => 'Kaveh',
            'quantity' => 1,
            'price' => 99.99,
            'description' => 'Husbunya Ren',
        ]);

        $updateData = [
            'code' => 'H001',
            'name' => 'Kaveh',
            'quantity' => 1,
            'price' => 199.99,
            'description' => 'Malewife keduanya Ren',
        ];

        $response = $this->put(route('products.update', $product->id), $updateData);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Product is updated successfully.');

        $updatedProduct = Product::find($product->id);

        $this->assertEquals($updateData['code'], $updatedProduct->code);
        $this->assertEquals($updateData['name'], $updatedProduct->name);
        $this->assertEquals($updateData['quantity'], $updatedProduct->quantity);
        $this->assertEquals($updateData['price'], $updatedProduct->price);
        $this->assertEquals($updateData['description'], $updatedProduct->description);
    }
}
