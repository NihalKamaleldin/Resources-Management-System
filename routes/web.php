<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ItemController;
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

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

//Customer Route
Route::resource('/customers', CustomerController::class);

//Supplier Route
Route::resource('/suppliers', SupplierController::class);

//Product Route
Route::resource('/products', ProductController::class);

//Item Route
Route::resource('/items', ItemController::class);