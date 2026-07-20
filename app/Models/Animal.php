<?php

namespace App\Models;

use App\Models\GestationRecord;
use App\Models\Treatment;
use App\Models\FeedingRecord;
use App\Models\Farm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_date',
        'breed',
        'species',
        'weight_kg',
        'last_weighing',
        'target_weight',
        'sex',
        'reproductive_status',
        'purchase_price',
        'estimated_price',
        'active',
        'farm_id'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'last_weighing' => 'date',        
        'active' => 'boolean'
    ];

    public function gestationRecords(): HasMany
    {
        return $this->hasMany(GestationRecord::class);
    }

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }

    public function feedingRecords(): HasMany
    {
        return $this->hasMany(FeedingRecord::class);
    }

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    } 
}
