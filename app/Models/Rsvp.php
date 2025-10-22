<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'is_attending',
        'attending_count',
        'message'
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
