<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FamiliaController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\OpcionController;
use App\Http\Controllers\Admin\SubcategoriaController;
use App\Http\Controllers\Admin\ProvedorController;
use App\Http\Controllers\Admin\ProductoController;


// Admin routes
Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('familias', FamiliaController::class)->parameters([
    'familias' => 'familia'
]);

Route::resource('categorias', CategoriaController::class)->parameters([
    'categorias' => 'categoria'
]);

Route::resource('subcategorias', SubcategoriaController::class)->parameters([
    'subcategorias' => 'subcategoria'
]);

Route::resource('provedores', ProvedorController::class)->parameters([
    'provedores' => 'provedor'
]);

Route::resource('productos', ProductoController::class)->parameters([
    'productos' => 'producto'
]);

Route::get('/opciones',[OpcionController::class,'index'])->name('opciones.index');





