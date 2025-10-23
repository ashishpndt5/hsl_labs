<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            ['name' => 'Surgery Supplement 30-Day Pack', 'stock' => 200, 'price' => 49.99],
            ['name' => 'Post-Op Supplement 12-Month Pack', 'stock' => 100, 'price' => 499.99],
        ]);
    }
}
