<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $categories = Category::all();
        $attributes = Attribute::all();

        // Create 50 products
        for ($i = 0; $i < 50; $i++) {
            $name = $faker->words(3, true);
            $product = Product::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $faker->paragraph(),
                'price' => $faker->randomFloat(2, 10, 1000),
                'stock' => $faker->numberBetween(0, 100),
                'sku' => $faker->unique()->ean8,
                'barcode' => $faker->unique()->ean8,
                'is_active' => true,
                'created_by' => User::inRandomOrder()->first()->id,
                'updated_by' => User::inRandomOrder()->first()->id,
                'thumbnail' => $faker->imageUrl(),
                'gallery' => json_encode($faker->imageUrl(640, 480, 'product', true)),
            ]);

            // Attach random categories (1-3)
            $product->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );

            // Attach random attributes with values
            $randomAttributes = $attributes->random(rand(2, 4));
            foreach ($randomAttributes as $attribute) {
                $value = $this->generateAttributeValue($attribute);
                $product->attributes()->attach($attribute->id, ['value' => $value]);
            }
        }
    }

    private function generateAttributeValue($attribute)
    {
        $faker = Faker::create();

        switch ($attribute->type) {
            case 'select':
                $options = json_decode($attribute->options, true);
                return $options[array_rand($options)];
            case 'number':
                return $faker->numberBetween(1, 100);
            case 'text':
            default:
                return $faker->word;
        }
    }
}
