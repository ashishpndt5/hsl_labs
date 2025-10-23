<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Events\StockUpdated;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function updateStock(UpdateInventoryRequest  $request): RedirectResponse
    {
        $validated = $request->validated();

        $product = Product::findOrFail($request->product_id);
        $oldStock = $product->stock;
        $newStock = $product->stock + $request->quantity_change;

        if ($newStock < 0) {
            return back()->withErrors(['quantity_change' => 'Not enough stock to reduce.']);
        }

        $product->update(['stock' => $newStock]);

        event(new StockUpdated($product, $oldStock, $newStock));

        return back()->with('success', 'Stock updated successfully!');
    }

}
