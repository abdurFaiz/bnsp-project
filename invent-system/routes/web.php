<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class);

// Export routes
Route::get('/products-export/excel', [ProductController::class, 'exportExcel'])->name('products.export.excel');
Route::get('/products-export/pdf', [ProductController::class, 'exportPdf'])->name('products.export.pdf');