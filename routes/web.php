<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GameController;

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


Route::get('/',[IndexController::class, 'index']);
Route::get('/{slug}', [IndexController::class, 'game']);

//Route::resource('ajax-posts', 'ajaxcrud\AjaxPostController');



Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('auth');
Route::get('admin/belepes', [App\Http\Controllers\AdminController::class, 'login'])->name('admin/belepes');
Route::get('admin/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin/login');


Route::get('/admin/games', [GameController::class, 'admin']);


