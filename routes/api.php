<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LivedataController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/login', [AuthController::class, 'login'])->middleware('auth:sanctum'); 
Route::get('/livedata', [LivedataController::class, 'postlivedata'])->middleware('auth:sanctum'); 
Route::post('/login', [AuthController::class, 'create_user']); 