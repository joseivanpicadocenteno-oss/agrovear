<?php

namespace App\Models;

use App\Models\RecipeDetail;
use App\Models\FeedingRecord;
use App\Models\Farm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'objective',
        'frequent_use',
        'filter_species',
        'min_age_filter',
        'max_age_filter',
        'min_weight_filter',
        'recommended_duration_days',
        'suitable_for_gestation',
        'suitable_for_location',
        'farm_id'
    ];

    protected $casts = [
        'min_age_filter' => 'integer',
        'max_age_filter' => 'integer',
        'min_weight_filter' => 'decimal:2',
        'recommended_duration_days' => 'integer',
        'suitable_for_gestation' => 'boolean',
        'suitable_for_location' => 'boolean',
    ];

    public function recipeDetails():HasMany
    {
        return $this->hasMany(RecipeDetail::class);
    }

    public function feedingRecords():HasMany
    {
        return $this->hasMany(FeedingRecord::class);
    }

     public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
}
