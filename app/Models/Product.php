<?php

namespace App\Models;

use App\Models\RecipeDetails;
use App\Models\TreatmentDetails;
use App\Models\Farm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'unit_measurement',
        'current_stock',
        'min_stock',
        'unit_cost',
        'historical_average_price',
        'last_purchase_date',
        'regular_supplier',
        'batch',
        'expiration_date',
        'farm_id'
    ];

    protected $casts = [
        'unit_measurement' => 'integer',
        'current_stock' => 'integer',
        'min_stock' => 'decimal:2',
        'unit_cost' => 'decimal:2',
        'historical_average_price' => 'decimal:2',
        'last_purchase_date' => 'date',
        'expiration_date' => 'date',
    ];

    public function recipeDetails(): HasMany
    {
        return $this->hasMany(RecipeDetail::class);
    }

    public function treatmentDetails(): HasMany
    {
        return $this->hasMany(TreatmentDetail::class);
    }

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
}
