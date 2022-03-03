<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\admin\ProducFamiliesController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductTypeController;
use App\Http\Controllers\admin\ClientController;
use App\Http\Controllers\admin\QuoteController;

Route::get('/', [HomeController::class, 'index'])->name('home');


//Tipo de Productos
Route::get('/tipo_producto', [ProductTypeController::class, 'index'])->name('producttype.index');
Route::get('/tipo_producto/create', [ProductTypeController::class, 'create'])->name('producttype.create');
Route::post('/tipo_producto/store', [ProductTypeController::class, 'store'])->name('producttype.store');
Route::get('/tipo_producto/edit/{id}', [ProductTypeController::class,'edit'])->name('producttype.edit');
Route::put('/tipo_producto/{id}',  [ProductTypeController::class,'update'])->name('producttype.update');
Route::delete('/tipo_producto/{id}', [ProductTypeController::class, 'destroy'])->name('producttype.delete');
Route::get('/tipo_producto/show/{id}', [ProductTypeController::class, 'show'])->name('producttype.show');
Route::get('/tipo_producto/estado', [ProductTypeController::class,'UpdateStatusTipoProducto'])->name('UpdateStatusTipoProducto');
Route::post('/tipo_producto/buscar',[ProductTypeController::class, 'buscar'])->name('producttype.buscar');


//familia de Productos
Route::get('/familia_producto', [ProducFamiliesController::class, 'index'])->name('productfamily.index');
Route::get('/familia_producto/create', [ProducFamiliesController::class, 'create'])->name('productfamily.create');
Route::post('/familia_producto/store', [ProducFamiliesController::class, 'store'])->name('productfamily.store');
Route::get('/familia_producto/edit/{id}', [ProducFamiliesController::class,'edit'])->name('productfamily.edit');
Route::put('/familia_producto/{id}',  [ProducFamiliesController::class,'update'])->name('productfamily.update');
Route::delete('/familia_producto/{id}', [ProducFamiliesController::class, 'destroy'])->name('productfamily.delete');
Route::get('/familia_producto/show/{id}', [ProducFamiliesController::class, 'show'])->name('productfamily.show');
Route::get('/familia_producto/estado', [ProducFamiliesController::class,'UpdateStatusFamiliaProducto'])->name('UpdateStatusFamiliaProducto');
Route::post('/familia_producto/buscar',[ProducFamiliesController::class, 'buscar'])->name('productfamily.buscar');

//Productos
Route::get('/producto', [ProductController::class, 'index'])->name('product.index');
Route::get('/producto/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/producto/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/producto/edit/{id}', [ProductController::class,'edit'])->name('product.edit');
Route::put('/producto/{id}',  [ProductController::class,'update'])->name('product.update');
Route::delete('/producto/{id}', [ProductController::class, 'destroy'])->name('product.delete');
Route::get('/producto/show/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/producto/estado', [ProductController::class,'UpdateStatusProducto'])->name('UpdateStatusProducto');
Route::post('/producto/buscar',[ProductController::class, 'buscar'])->name('product.buscar');


//Clientes
Route::get('/cliente', [ClientController::class, 'index'])->name('client.index');
Route::get('/cliente/create', [ClientController::class, 'create'])->name('client.create');
Route::post('/cliente/store', [ClientController::class, 'store'])->name('client.store');
Route::get('/cliente/edit/{id}', [ClientController::class,'edit'])->name('client.edit');
Route::put('/cliente/{id}',  [ClientController::class,'update'])->name('client.update');
Route::delete('/cliente/{id}', [ClientController::class, 'destroy'])->name('client.delete');
Route::get('/cliente/show/{id}', [ClientController::class, 'show'])->name('client.show');
Route::get('/cliente/estado', [ClientController::class,'UpdateStatusclientes'])->name('UpdateStatusclient');
Route::post('/cliente/buscar',[ClientController::class, 'buscar'])->name('client.buscar');


//Cotizaciones
Route::get('/cotizacion', [QuoteController::class, 'index'])->name('quote.index');
Route::get('/cotizacion/create', [QuoteController::class, 'create'])->name('quote.create');
Route::post('/cotizacion/store', [QuoteController::class, 'store'])->name('quote.store');
Route::get('/cotizacion/edit/{id}', [QuoteController::class,'edit'])->name('quote.edit');
Route::put('/cotizacion/{id}',  [QuoteController::class,'update'])->name('quote.update');
Route::delete('/cotizacion/{id}', [QuoteController::class, 'destroy'])->name('quote.delete');
Route::get('/cotizacion/show/{id}', [QuoteController::class, 'show'])->name('quote.show');
Route::get('/cotizacion/estado', [QuoteController::class,'UpdateStatusCotizacion'])->name('UpdateStatusquote');
Route::post('/cotizacion/buscar',[QuoteController::class, 'buscar'])->name('quote.buscar');
