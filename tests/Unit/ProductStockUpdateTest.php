<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Product;
use App\Events\StockUpdated;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductStockUpdateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }
    public function it_updates_stock_successfully_and_fires_event()
    {
        // Prevent actual email sending
        Event::fake([StockUpdated::class]);

        // Create a product
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'stock' => 10,
        ]);

        // Simulate form submission
        $response = $this->post('/update-stock', [
            'product_id' => $product->id,
            'quantity_change' => 5,
        ]);

        // Check redirect or success message
        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Assert DB updated
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock' => 15, // 10 + 5
        ]);

        // Assert event fired
        Event::assertDispatched(StockUpdated::class, function ($event) use ($product) {
            return $event->product->id === $product->id
                && $event->newStock === 15;
        });
    }

    /** @test */
    public function it_fails_when_stock_would_become_negative()
    {
        $product = Product::factory()->create([
            'name' => 'Low Stock Product',
            'stock' => 2,
        ]);

        // Submit invalid stock reduction
        $response = $this->post('/update-stock', [
            'product_id' => $product->id,
            'quantity_change' => -5, // invalid
        ]);

        // Expect validation error or custom message
        $response->assertSessionHasErrors();

        // Stock remains unchanged
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock' => 2,
        ]);
    }

}
