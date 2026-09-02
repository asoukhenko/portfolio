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

    protected $appends = [
        'cover_url',
        'gallery_urls',
    ];

    public function getCoverUrlAttribute(): ?string
    {
        if (empty($this->cover_image)) {
            return null;
        }

        if (str_starts_with($this->cover_image, 'http')) {
            return $this->cover_image;
        }

        return asset('storage/' . ltrim($this->cover_image, '/'));
    }

    public function getGalleryUrlsAttribute(): array
    {
        $gallery = $this->gallery;

        if (is_string($gallery)) {
            $gallery = json_decode($gallery, true) ?? [];
        }

        if (!is_array($gallery)) {
            return [];
        }

        $urls = [];
        foreach ($gallery as $item) {
            $path = is_array($item) ? ($item['image'] ?? null) : (is_string($item) ? $item : null);
            if (!empty($path)) {
                $urls[] = str_starts_with($path, 'http') ? $path : asset('storage/' . ltrim($path, '/'));
            }
        }

        // Переворачиваем массив для совпадения порядка с сайтом
        return array_reverse(array_values($urls));
    }
}
