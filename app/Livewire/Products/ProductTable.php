<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithTable;

class ProductTable extends Component
{
    use WithPagination, WithTable;

    protected $paginationTheme = 'tailwind';

    protected function baseQuery()
    {
        return Product::query();  // Your model
    }

    protected function searchableFields()
    {
        return ['name', 'sku', 'description'];  // Your searchable fields
    }

    public function render()
    {
        $products = $this->getTableQuery()->paginate($this->perPage);

        return view('livewire.products.product-table', [
            'products' => $products,
            'columns' => [
                [
                    'field' => 'name',
                    'label' => 'Product Name',
                ],
                [
                    'field' => 'price',
                    'label' => 'Price',
                    'component' => 'table.columns.price'  // Custom renderer if needed
                ],
                [
                    'field' => 'stock',
                    'label' => 'Stock Level'
                ],
            ],
            'filters' => [
                [
                    'field' => 'category',
                    'type' => 'select',
                    'label' => 'Category',
                    'options' => [
                        'electronics' => 'Electronics',
                        'clothing' => 'Clothing',
                    ],
                ],
            ],
            'actions' => [
                [
                    'type' => 'link',
                    'label' => 'Edit',
                    'url' => fn($row) => route('products.edit', $row),
                ],
                [
                    'type' => 'button',
                    'label' => 'Delete',
                    'action' => 'deleteProduct',
                ],
            ],
            'createRoute' => route('products.create'),
            'createText' => 'Add Product',
        ]);
    }
}
