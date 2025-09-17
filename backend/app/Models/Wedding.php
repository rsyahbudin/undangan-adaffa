<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Wedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'wedding_date',
        'is_active',
        'invitation_code',
        'cover_photo',
        'background_photo',
        'background_music',
    ];

    protected $casts = [
        'wedding_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the schedules for the wedding.
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get the rsvps for the wedding.
     */
    public function rsvps(): HasMany
    {
        return $this->hasMany(RSVP::class);
    }

    /**
     * Get the media for the wedding.
     */
    public function media(): HasMany
    {
        return $this->hasMany(Media::class);
    }

    /**
     * Get the couple associated with the wedding.
     */
    public function couple(): HasOne
    {
        return $this->hasOne(Couple::class);
    }

    /**
     * Get the guests for the wedding.
     */
    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }
}
