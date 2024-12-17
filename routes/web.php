<?php

use App\Models\Livedata;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;

Route::get('/', [StockController::class, 'show'])->name('home');

//Stock and Production Routes
Route::get('/getProdForm', [StockController::class, 'showProdForm']);
//Import products routes
// Route::get('/import-csv', [StockController::class, 'showForm'])->name('import.form');
Route::post('/import-csv', [StockController::class, 'importCsv'])->name('import.csv');


