<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'is_active',
        'parent_id',
        '_lft',
        '_rgt'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withTimestamps();
    }
}
