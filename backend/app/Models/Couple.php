<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Couple extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id',
        'groom_name',
        'groom_nickname',
        'groom_photo',
        'groom_father_name',
        'groom_mother_name',
        'bride_name',
        'bride_nickname',
        'bride_photo',
        'bride_father_name',
        'bride_mother_name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the wedding that owns the couple information.
     */
    public function wedding(): BelongsTo
    {
        return $this->belongsTo(Wedding::class);
    }
}
