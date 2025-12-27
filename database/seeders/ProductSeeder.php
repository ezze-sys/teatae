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
        // Clear existing products to ensure a clean Warkop menu
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \App\Models\Product::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $products = [
            // Coffee (Warkop Style)
            ['name' => 'Kopi Liong', 'category_name' => 'Coffee', 'price' => 5000, 'stock' => 100],
            ['name' => 'Kopi Kapal Api', 'category_name' => 'Coffee', 'price' => 4000, 'stock' => 100],
            ['name' => 'Kopi ABC Susu', 'category_name' => 'Coffee', 'price' => 5000, 'stock' => 100],
            ['name' => 'Good Day Cappuccino', 'category_name' => 'Coffee', 'price' => 6000, 'stock' => 80],
            ['name' => 'Good Day Mocacinno', 'category_name' => 'Coffee', 'price' => 6000, 'stock' => 80],
            ['name' => 'Kopi Hitam (Seduh)', 'category_name' => 'Coffee', 'price' => 4000, 'stock' => 100],
            ['name' => 'Kopi Susu (Kental Manis)', 'category_name' => 'Coffee', 'price' => 6000, 'stock' => 100],
            
            // Non-Coffee
            ['name' => 'Es Teh Manis', 'category_name' => 'Non-Coffee', 'price' => 4000, 'stock' => 100],
            ['name' => 'Teh Manis Hangat', 'category_name' => 'Non-Coffee', 'price' => 3000, 'stock' => 100],
            ['name' => 'Es Jeruk', 'category_name' => 'Non-Coffee', 'price' => 6000, 'stock' => 50],
            ['name' => 'Jeruk Hangat', 'category_name' => 'Non-Coffee', 'price' => 5000, 'stock' => 50],
            ['name' => 'Soda Gembira', 'category_name' => 'Non-Coffee', 'price' => 12000, 'stock' => 30],
            ['name' => 'Nutrisari Dingin', 'category_name' => 'Non-Coffee', 'price' => 5000, 'stock' => 50],
            ['name' => 'Extra Joss Susu', 'category_name' => 'Non-Coffee', 'price' => 7000, 'stock' => 40],

            // Snack
            ['name' => 'Pisang Goreng', 'category_name' => 'Snack', 'price' => 2000, 'stock' => 50],
            ['name' => 'Tempe Mendoan', 'category_name' => 'Snack', 'price' => 2000, 'stock' => 50],
            ['name' => 'Tahu Isi', 'category_name' => 'Snack', 'price' => 2500, 'stock' => 40],
            ['name' => 'Bakwan Sayur', 'category_name' => 'Snack', 'price' => 2000, 'stock' => 40],
            ['name' => 'Roti Bakar Coklat Keju', 'category_name' => 'Snack', 'price' => 12000, 'stock' => 30],
            ['name' => 'Roti Bakar Nanas', 'category_name' => 'Snack', 'price' => 10000, 'stock' => 30],

            // Food (Indomie & Rice)
            ['name' => 'Indomie Goreng', 'category_name' => 'Food', 'price' => 8000, 'stock' => 100],
            ['name' => 'Indomie Rebus Ayam Bawang', 'category_name' => 'Food', 'price' => 8000, 'stock' => 100],
            ['name' => 'Indomie Rebus Soto', 'category_name' => 'Food', 'price' => 8000, 'stock' => 100],
            ['name' => 'Internet (Indomie Telor Kornet)', 'category_name' => 'Food', 'price' => 15000, 'stock' => 50],
            ['name' => 'Interjunet (Indomie Telor Keju Kornet)', 'category_name' => 'Food', 'price' => 18000, 'stock' => 40],
            ['name' => 'Nasi Goreng Gila', 'category_name' => 'Food', 'price' => 18000, 'stock' => 30],
            ['name' => 'Magelangan (Nasi Goreng Mawut)', 'category_name' => 'Food', 'price' => 15000, 'stock' => 30],
            ['name' => 'Bubur Kacang Ijo', 'category_name' => 'Food', 'price' => 8000, 'stock' => 40],
            ['name' => 'Bubur Ketan Hitam', 'category_name' => 'Food', 'price' => 8000, 'stock' => 40],

            // Dessert (Simple)
            ['name' => 'Pancong Lumer Coklat', 'category_name' => 'Dessert', 'price' => 10000, 'stock' => 30],
            ['name' => 'Pancong Lumer Keju', 'category_name' => 'Dessert', 'price' => 12000, 'stock' => 30],
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
