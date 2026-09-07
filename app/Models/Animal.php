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
        'farm_id',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'last_weighing' => 'date',
        'weight_kg' => 'decimal:2',
        'target_weight' => 'decimal:2',
        'purchase_price' => 'decimal:2',
        'estimated_price' => 'decimal:2',
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function getAgeInMonthsAttribute(): int
    {
        return $this->birth_date
            ? $this->birth_date->diffInMonths(now())
            : 0;
    }

    public function getWeightProgressAttribute(): float
    {
        if (!$this->target_weight || !$this->weight_kg) {
            return 0;
        }

        return min(
            100,
            ($this->weight_kg / $this->target_weight) * 100
        );
    }

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