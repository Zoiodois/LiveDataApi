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
// Route::post('/livedata2', [LivedataController::class, 'postlivedata']); //->middleware('auth:sanctum'); 
Route::post('/create-user', [AuthController::class, 'create_user']); 
Route::get('/create-token', [AuthController::class, 'create_token']); 

Route::middleware('api')->post('/test-endpoint', function (Request $request) {
    return response()->json(['message' => 'Success', 'data' => $request->all()]);
});

Route::post('livedata2', [LivedataController::class, 'postlivedata'])
    ->withoutMiddleware('csrf');