<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use App\Traits\WithForm;
use Illuminate\Support\Facades\DB;
use App\Models\Attribute;

class ProductForm extends Component
{
    use WithForm;

    public function mount(?Product $product = null)
    {
        $this->model = $product;
        $this->cancelRoute = 'products.index';
        $this->successMessage = $this->model && $this->model->exists ? 'Product updated successfully!' : 'Product created successfully!';

        // Set default values for new products only
        if (!$this->model || !$this->model->exists) {
            $this->data = [
                'stock' => 0,
                'is_active' => true,
                'categories' => [],
                'attributes' => [],
            ];
        } else {
            // For existing products, use their data
            $this->data = array_merge($this->model->toArray(), [
                'categories' => $this->model->categories->pluck('id')->toArray(),
                'attributes' => $this->model->attributes->mapWithKeys(function($attribute) {
                    return [$attribute->id => $attribute->pivot->value];
                })->toArray(),
            ]);
        }

        $this->initializeWithForm();
    }

    protected function getModelClass(): string
    {
        return Product::class;
    }

    protected function getFormRules()
    {
        return [
            'data.name' => ['required', 'string', 'max:255'],
            'data.slug' => ['required', 'string', 'max:255'],
            'data.description' => ['nullable', 'string'],
            'data.price' => ['required', 'numeric', 'min:0'],
            'data.stock' => ['required', 'integer', 'min:0'],
            'data.sku' => ['required', 'string', 'max:255'],
            'data.is_active' => ['boolean'],
            'data.categories' => ['array'],
            'data.categories.*' => ['exists:categories,id'],
            'data.attributes' => ['array'],
            'data.attributes.*' => ['string', 'max:255'],
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

    public function save()
    {
        $validatedData = $this->validate();

        DB::beginTransaction();
        try {
            if ($this->model && $this->model->exists) {
                $this->model->update($validatedData['data']);
            } else {
                $this->model = Product::create($validatedData['data']);
            }

            // Sync categories
            $this->model->categories()->sync($validatedData['data']['categories'] ?? []);

            // Sync attributes with their values
            $attributeData = collect($validatedData['data']['attributes'] ?? [])->map(function($value) {
                return ['value' => $value];
            })->toArray();
            $this->model->attributes()->sync($attributeData);

            DB::commit();
            session()->flash('success', $this->successMessage);
            return redirect()->route($this->cancelRoute);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error saving: ' . $e->getMessage());
            throw $e;
        }
    }

    public function render()
    {
        $fields = [
            $this->field('name', 'text', [
                'required' => true,
                'help' => 'Enter the product name as it will appear to customers'
            ]),
            $this->field('slug', 'text', [
                'required' => true,
                'help' => 'URL-friendly version of the name'
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
            $this->field('stock', 'number', [
                'required' => true,
                'min' => 0,
                'help' => 'Current stock quantity'
            ]),
            $this->field('sku', 'text', [
                'required' => true,
                'help' => 'Stock Keeping Unit'
            ]),
            $this->multipleSelect(
                'categories',
                Category::where('is_active', true)->pluck('name', 'id')->toArray(),
                [
                    'label' => 'Categories',
                    'help' => 'Select one or more categories'
                ]
            ),
            $this->checkbox('is_active', [
                'label' => 'Product is active',
                'help' => 'Inactive products will not be visible to customers'
            ])
        ];

        // Add dynamic attribute fields
        $attributes = Attribute::all();
        foreach ($attributes as $attribute) {
            $name = "attributes.{$attribute->id}";

            if ($attribute->type === 'select') {
                $options = is_string($attribute->options) ? json_decode($attribute->options, true) : ($attribute->options ?? []);
                if (!empty($options)) {
                    $fields[] = $this->select($name, $options, [
                        'label' => $attribute->name,
                        'required' => $attribute->is_required,
                        'help' => "Select a value for {$attribute->name}"
                    ]);
                } else {
                    // Fallback to text input if options are empty
                    $fields[] = $this->field($name, 'text', [
                        'label' => $attribute->name,
                        'required' => $attribute->is_required,
                        'help' => "Enter a value for {$attribute->name}"
                    ]);
                }
            } else {
                $fields[] = $this->field($name, 'text', [
                    'label' => $attribute->name,
                    'required' => $attribute->is_required,
                    'help' => "Enter a value for {$attribute->name}"
                ]);
            }
        }

        return view('livewire.products.product-form', [
            'fields' => $fields
        ]);
    }
}
