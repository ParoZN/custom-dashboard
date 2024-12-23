<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and accessories',
            ],
            [
                'name' => 'Clothing',
                'description' => 'Fashion and apparel',
            ],
            [
                'name' => 'Home & Garden',
                'description' => 'Home decor and garden supplies',
            ],
            [
                'name' => 'Books',
                'description' => 'Books and publications',
            ],
            [
                'name' => 'Sports',
                'description' => 'Sports equipment and accessories',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'is_active' => true,
            ]);
        }
    }
}
