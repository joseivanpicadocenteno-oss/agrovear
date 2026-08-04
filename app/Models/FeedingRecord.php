<?php

namespace App\Models;

use App\Models\Animal;
use App\Models\Recipe;
use App\Models\GestationRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeedingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'feeding_date',
        'amount_served',
        'estimated_feed_cost',
        'animal_id',
        'gestation_record_id',
        'recipe_id',
    ];

    protected $casts = [
        'feeding_date' => 'date',
        'amount_served' => 'decimal:2',
        'estimated_feed_cost' => 'decimal:2',
    ];

   // public function calculateEstimatedCost(): float
  //  {
  //  $cost = 0;

   // foreach ($this->recipe->recipeDetails as $detail) {
      //  $cost += $detail->quantity * $detail->product->unit_cost;
  //  }

 //  return $cost;
   // }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    /**
    * Puede ser null cuando el animal no está en gestación.
    */
    public function gestationRecord(): BelongsTo
    {
        return $this->belongsTo(GestationRecord::class);
    }

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }
}
