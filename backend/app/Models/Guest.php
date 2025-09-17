<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id',
        'name',
        'email',
        'invite_token',
        'phone',
        'session',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the wedding that owns the guest.
     */
    public function wedding(): BelongsTo
    {
        return $this->belongsTo(Wedding::class);
    }

    /**
     * Session constants
     */
    const SESSION_1 = 'session_1';
    const SESSION_2 = 'session_2';
    const SESSION_BOTH = 'both';

    /**
     * Get all session options
     */
    public static function getSessions(): array
    {
        return [
            self::SESSION_1 => 'Sesi 1 (Keluarga & Kerabat Dekat)',
            self::SESSION_2 => 'Sesi 2 (Teman & Kolega)',
            self::SESSION_BOTH => 'Kedua Sesi',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Guest $guest): void {
            if (empty($guest->invite_token)) {
                $guest->invite_token = static::generateUniqueInviteToken();
            }
        });
    }

    protected static function generateUniqueInviteToken(int $length = 12): string
    {
        do {
            $token = Str::random($length);
        } while (static::query()->where('invite_token', $token)->exists());

        return $token;
    }
}
