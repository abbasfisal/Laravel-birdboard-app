<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'auth'],function(){

    Route::get('/project/create' , [ProjectController::class , 'create']);
    Route::post('/project', [ProjectController::class, 'store']);
    Route::get('/project', [ProjectController::class, 'index']);
    Route::get('/project/{project}' , [ProjectController::class , 'show']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');

});

Auth::routes();

