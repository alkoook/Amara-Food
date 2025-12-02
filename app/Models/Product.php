<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'weight',
        'quantity',
        'added_date',
        'category_id',
        'brand_id',
    ];

    protected $casts = [
        'added_date' => 'date',
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