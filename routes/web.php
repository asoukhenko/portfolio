<?php

use App\Models\Project;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $projects = Project::latest()->get();
    $spheres = Project::pluck('sphere')->unique()->filter()->values();
    $years = Project::pluck('year')->unique()->filter()->values();
    
    // Получаем все настройки в формате ['key' => 'value']
    $settings = Setting::pluck('value', 'key')->all();

    return view('welcome', compact('projects', 'spheres', 'years', 'settings'));
});
