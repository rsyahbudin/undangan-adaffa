<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id',
        'type',
        'title',
        'description',
        'date',
        'start_time',
        'end_time',
        'location',
        'address',
        'maps_url',
        'is_active',
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the wedding that owns the schedule.
     */
    public function wedding(): BelongsTo
    {
        return $this->belongsTo(Wedding::class);
    }

    /**
     * Schedule types constants
     */
    const TYPE_AKAD = 'akad';
    const TYPE_RESEPSI_1 = 'resepsi_1';
    const TYPE_RESEPSI_2 = 'resepsi_2';

    /**
     * Get all schedule types
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_AKAD => 'Akad Nikah',
            self::TYPE_RESEPSI_1 => 'Resepsi Sesi 1',
            self::TYPE_RESEPSI_2 => 'Resepsi Sesi 2',
        ];
    }
}
