<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Coffee
            ['name' => 'Espresso', 'category_name' => 'Coffee', 'price' => 18000, 'stock' => 100],
            ['name' => 'Americano', 'category_name' => 'Coffee', 'price' => 20000, 'stock' => 100],
            ['name' => 'Cappuccino', 'category_name' => 'Coffee', 'price' => 25000, 'stock' => 80],
            ['name' => 'Caffe Latte', 'category_name' => 'Coffee', 'price' => 25000, 'stock' => 80],
            ['name' => 'Vanilla Latte', 'category_name' => 'Coffee', 'price' => 28000, 'stock' => 50],
            ['name' => 'Caramel Macchiato', 'category_name' => 'Coffee', 'price' => 30000, 'stock' => 50],
            ['name' => 'Mochaccino', 'category_name' => 'Coffee', 'price' => 28000, 'stock' => 60],
            
            // Non-Coffee
            ['name' => 'Chocolate', 'category_name' => 'Non-Coffee', 'price' => 25000, 'stock' => 50],
            ['name' => 'Matcha Latte', 'category_name' => 'Non-Coffee', 'price' => 28000, 'stock' => 40],
            ['name' => 'Red Velvet', 'category_name' => 'Non-Coffee', 'price' => 28000, 'stock' => 40],
            ['name' => 'Lemon Tea', 'category_name' => 'Non-Coffee', 'price' => 18000, 'stock' => 100],
            ['name' => 'Lychee Tea', 'category_name' => 'Non-Coffee', 'price' => 20000, 'stock' => 80],

            // Snack
            ['name' => 'French Fries', 'category_name' => 'Snack', 'price' => 20000, 'stock' => 50],
            ['name' => 'Chicken Nuggets', 'category_name' => 'Snack', 'price' => 25000, 'stock' => 40],
            ['name' => 'Platter (Mix)', 'category_name' => 'Snack', 'price' => 35000, 'stock' => 30],
            ['name' => 'Pisang Goreng', 'category_name' => 'Snack', 'price' => 15000, 'stock' => 60],
            ['name' => 'Roti Bakar', 'category_name' => 'Snack', 'price' => 18000, 'stock' => 50],

            // Food
            ['name' => 'Nasi Goreng Special', 'category_name' => 'Food', 'price' => 30000, 'stock' => 30],
            ['name' => 'Mie Goreng Special', 'category_name' => 'Food', 'price' => 28000, 'stock' => 30],
            ['name' => 'Rice Bowl Chicken Katsu', 'category_name' => 'Food', 'price' => 32000, 'stock' => 25],
            ['name' => 'Spaghetti Bolognese', 'category_name' => 'Food', 'price' => 35000, 'stock' => 20],

            // Dessert
            ['name' => 'Choco Lava Cake', 'category_name' => 'Dessert', 'price' => 25000, 'stock' => 20],
            ['name' => 'Affogato', 'category_name' => 'Dessert', 'price' => 22000, 'stock' => 30],
        ];

        foreach ($products as $productData) {
            $category = \App\Models\Category::where('name', $productData['category_name'])->first();
            if ($category) {
                \App\Models\Product::create([
                    'name' => $productData['name'],
                    'sku' => strtoupper(substr($productData['name'], 0, 3)) . rand(100, 999),
                    'price' => $productData['price'],
                    'stock' => $productData['stock'],
                    'category_id' => $category->id,
                    'is_stock_managed' => true,
                ]);
            }
        }
    }
}
