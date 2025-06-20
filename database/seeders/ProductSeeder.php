<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            Product::create([
                'name' => 'Product ' . $i,
                'price' => 50.00,
                'stock_quantity' => rand(5, 20),
            ]);
        }
    }
}
