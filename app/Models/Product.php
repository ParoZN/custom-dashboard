<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'sku',
        'is_active',
        'thumbnail',
        'gallery',
        'barcode',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'gallery' => 'array'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category')
            ->withTimestamps();
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute')
            ->withPivot('value')
            ->withTimestamps();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
