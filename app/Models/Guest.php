<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id',
        'name',
        'phone',
        'email',
        'session',
        'guest_count',
        'is_invited',
        'is_active',
        'slug', // tambahkan slug ke fillable
    ];

    protected static function boot()
    {
        parent::boot();

        // Isi slug otomatis dari name saat create atau update
        static::creating(function ($guest) {
            $guest->slug = Str::slug($guest->name);
        });

        static::updating(function ($guest) {
            $guest->slug = Str::slug($guest->name);
        });
    }

    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }

    public function rsvp()
    {
        return $this->hasOne(Rsvp::class);
    }

    // Buat URL undangan langsung
    public function getInvitationUrlAttribute()
    {
        return url('/sesi' . $this->session . '/' . $this->slug);
    }
}
