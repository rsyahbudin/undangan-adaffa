<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RSVP extends Model
{
    use HasFactory;

    protected $table = 'rsvps';

    protected $fillable = [
        'wedding_id',
        'name',
        'email',
        'phone',
        'attendance_status',
        'guest_count',
        'message',
        'attendance_date',
        'is_confirmed',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'is_confirmed' => 'boolean',
    ];

    /**
     * Get the wedding that owns the RSVP.
     */
    public function wedding(): BelongsTo
    {
        return $this->belongsTo(Wedding::class);
    }

    /**
     * Attendance status constants
     */
    const STATUS_ATTENDING = 'attending';
    const STATUS_NOT_ATTENDING = 'not_attending';
    const STATUS_MAYBE = 'maybe';

    /**
     * Get all attendance statuses
     */
    public static function getAttendanceStatuses(): array
    {
        return [
            self::STATUS_ATTENDING => 'Hadir',
            self::STATUS_NOT_ATTENDING => 'Tidak Hadir',
            self::STATUS_MAYBE => 'Mungkin Hadir',
        ];
    }
}
