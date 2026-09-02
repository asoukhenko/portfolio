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

    public function getGalleryAttribute($value)
    {
        if (empty($value)) {
            return [];
        }

        $data = is_string($value) ? json_decode($value, true) : $value;
        if (!is_array($data)) {
            return [];
        }

        $formatted = [];
        foreach ($data as $item) {
            if (is_string($item)) {
                $formatted[] = ['image' => $item];
            } elseif (is_array($item)) {
                $formatted[] = $item;
            }
        }

        return $formatted;
    }

    public function setGalleryAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['gallery'] = json_encode(array_values($value));
        } else {
            $this->attributes['gallery'] = json_encode([]);
        }
    }
}
