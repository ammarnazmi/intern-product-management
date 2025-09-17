<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', productController::class)->except(['show']);
