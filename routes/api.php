<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->group(function (){
    Route::get('products', 'index');
    Route::post('products', 'store');

    Route::post('products/{id}', 'update');

    Route::delete('products/{product}', 'destroy');

//    Route::get('product/{id}', 'show');
});
