<?php

use App\Models\Livedata;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StockController;

Route::get('/', [StockController::class, 'show'])->name('home');
Route::get('/exemple', [StockController::class, 'exemple'])->name('home');

//User Autentication and Login Routes -> AuthController
Route::get('/login', [AuthController::class, 'showLoginPage']);
Route::post('/login', [AuthController::class, 'login']);



//Stock and Production Routes
Route::get('/getProdForm', [StockController::class, 'showProdForm']);
Route::get('/editProdForm/{prod}' , [StockController::class, 'editProdForm']);
// Route::put('/editProdForm/{prod}' , [StockController::class, 'updateForm']);
Route::put('/updateForm' , [StockController::class, 'updateForm']);

//Test Routes
// Route::get('test-edit' , [StockController::class, 'teste']);
// Route::put('test-edit' , [StockController::class, 'teste']);  -> Nao funcionou, diz que o request é GET mesmo sendo PUT no form
Route::patch('test-edit' , [StockController::class, 'teste']);


// Route::get('/production', [ProductionController::class, 'showPage']);
// Route::post('/production', [ProductionController::class, 'postProduction']);
// Route::get('/getProdForm' , [ProductionController::class, 'showProdForm']);





//Import products routes
// Route::get('/import-csv', [StockController::class, 'showForm'])->name('import.form');
Route::post('/import-csv', [StockController::class, 'importCsv'])->name('import.csv');


