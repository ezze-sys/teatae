<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Coffee', 'type' => 'drink'],
            ['name' => 'Non-Coffee', 'type' => 'drink'],
            ['name' => 'Snack', 'type' => 'snack'],
            ['name' => 'Food', 'type' => 'food'],
            ['name' => 'Dessert', 'type' => 'snack'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
