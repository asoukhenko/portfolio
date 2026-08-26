<?php

use App\Models\Project;
use App\Models\Setting;
use App\Models\Sphere;
use App\Models\Year;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $projects = Project::orderBy('sort', 'asc')->get();
    $settings = Setting::pluck('value', 'key')->all();

    // Получаем сферы из справочника (с фолбеком на значения из проектов, если справочник пуст)
    $spheres = Sphere::pluck('name');
    if ($spheres->isEmpty()) {
        $spheres = Project::pluck('sphere')->unique()->filter()->values();
    }

    // Получаем года из справочника с сортировкой по убыванию (с фолбеком на проекты)
    $years = Year::orderBy('name', 'desc')->pluck('name');
    if ($years->isEmpty()) {
        $years = Project::pluck('year')->unique()->filter()->values();
    }

    return view('welcome', compact('projects', 'spheres', 'years', 'settings'));
});