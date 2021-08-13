<?php

use App\Http\Controllers\ProjectController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/project', [ProjectController::class, 'store'])->middleware('auth');

Route::get('/project', [ProjectController::class, 'index']);
Route::get('/project/{project}' , [ProjectController::class , 'show']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
