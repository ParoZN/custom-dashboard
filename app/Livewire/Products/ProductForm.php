<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use App\Traits\WithForm;

class ProductForm extends Component
{
    use WithForm;

    public function mount(?Product $product = null)
    {
        logger()->info('ProductForm mounting', [
            'product_received' => $product ? $product->toArray() : []
        ]);

        $this->model = $product;
        $this->cancelRoute = 'products.index';
        $this->successMessage = $this->model && $this->model->exists ? 'Product updated successfully!' : 'Product created successfully!';

        // Set default values for new products only
        if (!$this->model || !$this->model->exists) {
            $this->data = [
                'stock' => 0,
                'image' => 'placeholder.jpg',
                'brand' => 'Default Brand',
                'supplier' => 'Default Supplier',
                'status' => 'Active',
            ];
        } else {
            // For existing products, use their data
            $this->data = $this->model->toArray();
        }

        logger()->info('Before initializeWithForm', [
            'model' => $this->model ? $this->model->toArray() : [],
            'data' => $this->data
        ]);

        $this->initializeWithForm();
        
        logger()->info('After initializeWithForm', [
            'model' => $this->model ? $this->model->toArray() : [],
            'data' => $this->data
        ]);
    }

    protected function getModelClass(): string
    {
        return Product::class;
    }

    protected function getFormRules()
    {
        return [
            'data.name' => ['required', 'string', 'max:255'],
            'data.price' => ['required', 'numeric', 'min:0'],
            'data.description' => ['nullable', 'string'],
            'data.category' => ['required', 'string'],
            'data.is_active' => ['boolean'],
            'data.stock' => ['required', 'integer', 'min:0'],
            'data.image' => ['required', 'string'],
            'data.brand' => ['required', 'string'],
            'data.supplier' => ['required', 'string'],
            'data.status' => ['required', 'string'],
        ];
    }

    public function updated($field)
    {
        $value = data_get($this, $field);
        $fieldName = str_replace('data.', '', $field);
        $this->data[$fieldName] = $value;
        
        logger()->info('Field updated: ' . $field, [
            'value' => $value,
            'all_data' => $this->data
        ]);
    }

    public function render()
    {
        logger()->info('ProductForm rendering', [
            'current_data' => $this->data
        ]);

        return view('livewire.products.product-form', [
            'fields' => [
                $this->field('name', 'text', [
                    'required' => true,
                    'help' => 'Enter the product name as it will appear to customers'
                ]),
                $this->field('price', 'number', [
                    'required' => true,
                    'step' => '0.01',
                    'min' => 0
                ]),
                $this->textarea('description', [
                    'rows' => 4,
                    'help' => 'Detailed product description'
                ]),
                $this->select('category', [
                    'electronics' => 'Electronics',
                    'clothing' => 'Clothing',
                    'food' => 'Food & Beverages'
                ], [
                    'required' => true
                ]),
                $this->field('stock', 'number', [
                    'required' => true,
                    'min' => 0,
                    'help' => 'Current stock quantity'
                ]),
                $this->field('brand', 'text', [
                    'required' => true,
                    'help' => 'Product brand name'
                ]),
                $this->field('supplier', 'text', [
                    'required' => true,
                    'help' => 'Product supplier name'
                ]),
                $this->select('status', [
                    'Active' => 'Active',
                    'Inactive' => 'Inactive',
                    'Out of Stock' => 'Out of Stock'
                ], [
                    'required' => true
                ]),
                $this->checkbox('is_active', [
                    'label' => 'Product is active',
                    'help' => 'Inactive products will not be visible to customers'
                ])
            ]
        ]);
    }
}
