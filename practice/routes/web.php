<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// ログイン画面
Route::get('/list', [App\Http\Controllers\ArticleController::class, 'showList'])->name('list');

Route::get('/regist',[App\Http\Controllers\ArticleController::class, 'showRegistForm'])->name('regist');

Route::post('/regist',[App\Http\Controllers\ArticleController::class, 'registSubmit'])->name('submit');