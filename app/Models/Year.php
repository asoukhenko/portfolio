<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Year extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::updated(function ($yearModel) {
            $col = Schema::hasColumn('years', 'year') ? 'year' : (Schema::hasColumn('years', 'name') ? 'name' : (Schema::hasColumn('years', 'title') ? 'title' : 'value'));
            
            if ($yearModel->wasChanged($col)) {
                $oldYear = (string)$yearModel->getOriginal($col);
                $newYear = (string)$yearModel->$col;

                if ($oldYear && $newYear) {
                    Project::where('year', $oldYear)->update(['year' => $newYear]);
                }
            }
        });
    }
}
