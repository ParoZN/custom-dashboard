<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'category',
        'is_active',
        'stock',
        'image',
        'brand',
        'supplier',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];
}
