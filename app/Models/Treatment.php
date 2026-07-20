<?php

namespace App\Models;
use App\Models\Animal;
use App\Models\TreatmentDetail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'diagnosis',
        'observations',
        'active',
        'animal_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'active' => 'boolean',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function treatmentDetails(): HasMany
    {
        return $this->hasMany(TreatmentDetail::class);
    }
}
