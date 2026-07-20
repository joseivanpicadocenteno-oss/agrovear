<?php

namespace App\Models;

use App\Models\Animal;
use App\Models\FeedingRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GestationRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_date',
        'estimated_birth_date',
        'actual_birth_date',
        'live_births',
        'stillbirths',
        'observations',
        'active',
        'animal_id'
    ];

    protected $casts = [
        'service_date' => 'date',
        'estimated_birth_date' => 'date',
        'actual_birth_date' => 'date',
        'live_births' => 'integer',
        'stillbirths' => 'integer',
        'active' => 'boolean',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function feedingRecords(): HasMany
    {
        return $this->hasMany(FeedingRecord::class);
    }
}
