<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', Controllers\productController::class)->except(['show']);
Route::resource('subproducts', Controllers\SubproductController::class);
