<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id', 'cover_photo', 'music_path'
    ];

    public function wedding() {
        return $this->belongsTo(Wedding::class);
    }
}

