<?php

namespace App\Models;

use App\Models\Animal;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department',
        'municipality',
        'address',
        'phone',
        'description',
        'active',
        'user_id'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

      public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
