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
        return Product::query()
            ->with(['categories', 'attributes']);  // Eager load relationships
    }

    protected function searchableFields()
    {
        return ['name', 'sku', 'description'];
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
                    'component' => 'table.columns.price'
                ],
                [
                    'field' => 'stock',
                    'label' => 'Stock Level'
                ],
                [
                    'field' => 'categories',
                    'label' => 'Categories',
                    'component' => 'table.columns.categories'
                ],
                [
                    'field' => 'attributes',
                    'label' => 'Attributes',
                    'component' => 'table.columns.attributes'
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
