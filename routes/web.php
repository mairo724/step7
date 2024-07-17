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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();


// 一覧画面の表示
Route::get('/product_list', [App\Http\Controllers\ProductController::class, 'index'])->name('product_list');
// 検索ボタンを押したときの一覧画面の表示
Route::get('/product_list_search', [App\Http\Controllers\ProductController::class, 'search'])->name('product_list_search');
// リストの削除
Route::post('/destroy{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('product_delete');
// 登録画面の表示
Route::get('/product_new_register', [App\Http\Controllers\productController::class, 'productNewRegister'])->name('product_new_register');
// 登録画面の登録処理
Route::post('/product_new_register',[App\Http\Controllers\ProductController::class, 'productNewRegistSubmit'])->name('product_new_regist_submit');
// 詳細画面の表示
Route::get('/product_details_information/{id}', [App\Http\Controllers\ProductController::class, 'productDetailsInformation'])->name('product_details_information');
// 編集画面の表示
Route::get('/product_information_edit/{id}', [App\Http\Controllers\ProductController::class, 'productInformationEdit'])->name('product_information_edit');
// 詳細画面の更新処理
Route::post('/product_information_edit/{id}', [App\Http\Controllers\ProductController::class, 'productDetailsInformationUpdate'])->name('product_details_information_update');
// 購入処理のAPI
Route::post('/orders', [App\Http\Controllers\OrderController::class, 'placeOrder']);

Route::get('/testorders', [App\Http\Controllers\OrderController::class, 'testOrder']);

Auth::routes();

//?? Route::get('/home', [App\Http\Controllers\ProductController::class, 'index'])->name('product_list');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
