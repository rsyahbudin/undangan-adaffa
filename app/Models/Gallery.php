<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id', 'file_path', 'video_url'
    ];

    public function wedding() {
        return $this->belongsTo(Wedding::class);
    }
}

