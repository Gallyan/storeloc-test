<?php

use App\Http\Controllers\StorelocController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [StorelocController::class, 'index'])->name('index');

Route::get('/services', [ServicesController::class,'index'])->name('services.index');
Route::get('/services/{service}', [ServicesController::class,'show'])->whereNumber('service')->name('services.show');

Route::get('/stores', [StoresController::class,'index'])->name('stores.index');
Route::get('/stores/{store}', [StoresController::class,'show'])->whereNumber('store')->name('stores.show');

Route::get('/resultats', [StorelocController::class, 'results'])->name('results');
