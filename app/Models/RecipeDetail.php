<?php

namespace App\Models;

use App\Models\Recipe;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecipeDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'instruction',
        'recipe_id',
        'product_id',
    ];

    protected $casts = [
        'quantity' => 'decimal'
    ];

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
