<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'gallery' => 'array',
    ];

    // Включаем аксессоры в JSON-сериализацию для фронтенда и Alpine.js
    protected $appends = [
        'cover_image_url',
        'cover_url',
        'gallery_urls',
    ];

    protected static function booted(): void
    {
        static::creating(function ($project) {
            if (is_null($project->sort)) {
                static::query()->increment('sort');
                $project->sort = 1;
            }
        });
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        if (empty($this->cover_image)) {
            return null;
        }
        return str_starts_with($this->cover_image, 'http')
            ? $this->cover_image
            : asset('storage/' . $this->cover_image);
    }

    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_image_url;
    }

    public function getGalleryUrlsAttribute(): array
    {
        if (empty($this->gallery) || !is_array($this->gallery)) {
            return [];
        }

        return array_map(function ($path) {
            return str_starts_with($path, 'http') ? $path : asset('storage/' . $path);
        }, array_reverse($this->gallery));
    }
}
