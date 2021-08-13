<?php

use App\Http\Controllers\ProjectController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/project', [ProjectController::class, 'store']);

Route::get('/project', [ProjectController::class, 'index']);
