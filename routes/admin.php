<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FamiliaController;
use App\Http\Controllers\Admin\CategoriaController;

// Admin routes
Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('familias', FamiliaController::class);

Route::resource('categorias', CategoriaController::class);
