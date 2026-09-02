<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Sphere extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::updated(function ($sphere) {
            $col = Schema::hasColumn('spheres', 'name') ? 'name' : (Schema::hasColumn('spheres', 'title') ? 'title' : 'name');
            
            if ($sphere->wasChanged($col)) {
                $oldName = $sphere->getOriginal($col);
                $newName = $sphere->$col;

                if ($oldName && $newName) {
                    Project::where('sphere', $oldName)->update(['sphere' => $newName]);
                }
            }
        });
    }
}
