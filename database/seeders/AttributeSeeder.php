<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        $attributes = [
            [
                'name' => 'Color',
                'type' => 'select',
                'is_filterable' => true,
                'options' => ['Red', 'Blue', 'Green', 'Black', 'White'],
            ],
            [
                'name' => 'Size',
                'type' => 'select',
                'is_filterable' => true,
                'options' => ['XS', 'S', 'M', 'L', 'XL', 'XXL'],
            ],
            [
                'name' => 'Material',
                'type' => 'select',
                'is_filterable' => true,
                'options' => ['Cotton', 'Polyester', 'Leather', 'Metal', 'Plastic'],
            ],
            [
                'name' => 'Weight',
                'type' => 'number',
                'is_filterable' => true,
            ],
            [
                'name' => 'Brand',
                'type' => 'text',
                'is_filterable' => true,
            ],
        ];

        foreach ($attributes as $attribute) {
            Attribute::create([
                'name' => $attribute['name'],
                'type' => $attribute['type'],
                'is_filterable' => $attribute['is_filterable'],
                'options' => isset($attribute['options']) ? json_encode($attribute['options']) : null,
            ]);
        }
    }
}
