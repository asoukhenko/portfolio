<?php

use App\Models\Project;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $projects = Project::orderBy('year', 'desc')->get();
    $spheres = Project::select('sphere')->distinct()->pluck('sphere');
    $years = Project::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');

    return view('welcome', compact('projects', 'spheres', 'years'));
});
