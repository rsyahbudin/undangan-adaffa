<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'bride_name',
        'bride_nickname',
        'bride_photo',
        'bride_father_name',
        'bride_mother_name',
        'groom_name',
        'groom_nickname',
        'groom_photo',
        'groom_father_name',
        'groom_mother_name',
        'akad_date',
        'akad_start_time',
        'akad_end_time',
        'akad_place',
        'reception1_date',
        'reception1_start_time',
        'reception1_end_time',
        'reception1_place',
        'reception2_date',
        'reception2_start_time',
        'reception2_end_time',
        'reception2_place',
        'maps_url',
    ];

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function settings()
    {
        return $this->hasOne(Setting::class);
    }
}
