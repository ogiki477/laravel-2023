<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MyController;

// Resource Route
//Route::resource('post',PostController::class);
// Custom Routes

Route::get('/home',[PostController::class,'show_my_view']);

Route::get('post/{id}/{name}/{password}',[PostController::class,'show_post']);

Route::get('/My',[MyController::class,'MyControllerFunction']);


Route::get('posted/{id}/{password}/{name}',[MyController::class,'show_post']);