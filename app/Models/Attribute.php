<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attribute extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'is_required',
        'is_filterable',
        'options'
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_filterable' => 'boolean',
        'options' => 'array'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('value')
            ->withTimestamps();
    }
}
