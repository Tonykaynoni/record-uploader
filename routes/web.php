<?php

use App\Http\Controllers\CustomerDetailsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [CustomerDetailsController::class, 'index']);

Route::post('/upload', [CustomerDetailsController::class, 'upload']);
Route::get('/store-data', [CustomerDetailsController::class, 'storeData']);
Route::get('/test-data', [CustomerDetailsController::class, 'checkDate']);
