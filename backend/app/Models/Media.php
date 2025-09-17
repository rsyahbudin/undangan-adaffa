<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id',
        'type',
        'title',
        'description',
        'file_path',
        'file_url',
        'youtube_url',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the wedding that owns the media.
     */
    public function wedding(): BelongsTo
    {
        return $this->belongsTo(Wedding::class);
    }

    /**
     * Media types constants
     */
    const TYPE_COVER = 'cover';
    const TYPE_BACKGROUND = 'background';
    const TYPE_GALLERY = 'gallery';
    const TYPE_PREWEDDING_VIDEO = 'prewedding_video';
    const TYPE_BACKGROUND_MUSIC = 'background_music';

    /**
     * Get all media types
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_COVER => 'Cover Photo',
            self::TYPE_BACKGROUND => 'Background Photo',
            self::TYPE_GALLERY => 'Gallery Photo',
            self::TYPE_PREWEDDING_VIDEO => 'Prewedding Video',
            self::TYPE_BACKGROUND_MUSIC => 'Background Music',
        ];
    }
}
