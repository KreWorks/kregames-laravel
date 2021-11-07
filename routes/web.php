<?php

use Illuminate\Support\Facades\Route;
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

//Admin routes

Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('auth');
Route::get('admin/belepes', [App\Http\Controllers\AdminController::class, 'login'])->name('admin/belepes');
Route::get('admin/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin/login');

Route::get('/',[GameController::class, 'index']);
Route::get('/admin/games', [GameController::class, 'admin']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

