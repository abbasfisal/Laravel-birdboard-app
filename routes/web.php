<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTasksController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'auth'],function(){

    Route::get('/project/create' , [ProjectController::class , 'create']);
    Route::post('/project', [ProjectController::class, 'store']);
    Route::get('/project', [ProjectController::class, 'index']);

    Route::patch('/project/{project}' , [ProjectController::class , 'update']);
    Route::get('/project/{project}/edit' , [ProjectController::class , 'edit']);

    Route::get('/project/{project}' , [ProjectController::class , 'show']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //tasks
    Route::post('/project/{project}/tasks',[ProjectTasksController::class , 'store']);
    Route::patch('/project/{project}/tasks/{task}',[ProjectTasksController::class , 'update']);
});

Auth::routes();

