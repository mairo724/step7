<?php

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

Auth::routes();

Route::get('/product_list', [App\Http\Controllers\ProductListController::class, 'index'])->name('product_list');

Route::get('/product_new_register', [App\Http\Controllers\ProductNewRegisterController::class, 'productNewRegister'])->name('product_new_register');
Route::post('/product_new_register',[App\Http\Controllers\ProductNewRegisterController::class, 'productNewRegistsubmit'])->name('product_new_registSubmit');

Route::get('/product_details_information', [App\Http\Controllers\ProductDetailsInformationController::class, 'index'])->name('product_details_information');

Route::get('/product_information_edit', [App\Http\Controllers\ProductInformationEditController::class, 'index'])->name('product_information_edit');