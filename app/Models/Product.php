<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'weight',
        'quantity',
        'expiry_date',
        'added_date',
        'category_id',
        'brand_id',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'added_date' => 'date',
        'weight' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}

