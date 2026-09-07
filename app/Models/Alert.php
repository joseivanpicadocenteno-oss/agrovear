
<?php

namespace App\Models;

use App\Models\User;
use App\Models\Farm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'farm_id',
        'type',
        'title',
        'message',
        'severity',
        'read_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'read_at' => 'date',
        'created_at' => 'date',        
        'updated_at' => 'date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

}
