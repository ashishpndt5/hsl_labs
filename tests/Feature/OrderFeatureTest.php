<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderFeatureTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_provider_can_place_order()
    {
        $provider = Provider::factory()->create();
        $product = Product::factory()->create(['stock' => 10]);

        $response = $this->actingAs($provider)->postJson('/api/orders', [
            'provider_id' => $provider->id,
            'items' => [['product_id' => $product->id, 'quantity' => 2]]
        ]);

        $response->assertStatus(200)->assertJson(['message' => 'Order placed successfully!']);
    }

    public function test_cannot_order_if_stock_insufficient()
    {
        $provider = Provider::factory()->create();
        $product = Product::factory()->create(['stock' => 1]);

        $response = $this->actingAs($provider)->postJson('/api/orders', [
            'provider_id' => $provider->id,
            'items' => [['product_id' => $product->id, 'quantity' => 10]]
        ]);

        $response->assertStatus(500);
    }

}
