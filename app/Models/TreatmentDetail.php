<?php

namespace App\Models;

use App\Models\Treatment;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TreatmentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity_used',
        'frequency',
        'instructions',
        'treatment_id',
        'product_id',
    ];

    protected $casts = [
        'quantity_used' => 'decimal',
    ];

    public function treatment(): BelongsTo
    {
        return $this->belongsTo(Treatment::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
