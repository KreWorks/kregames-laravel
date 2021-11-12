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

Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::get('admin/login', [AdminController::class, 'login'])->name('admin/login');
Route::post('admin/authenticate', [AdminController::class, 'authenticate'])->name('admin/authenticate'); 
Route::get('admin/registration', [AdminController::class, 'registration'])->name('admin/registration');
Route::post('admin/register', [AdminController::class, 'register'])->name('admin/register'); 
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin/logout');


/*
Route::get('/admin/games', [GameController::class, 'admin']);

Route::get('/admin/belepes', [AdminController::class, 'login'])->name('admin/belepes');
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin/login');
Route::post('/admin/authenticate', [AdminController::class, 'authenticate'])->name('/admin/authenticate');
*/
Route::get('/{slug}', [IndexController::class, 'game']);

Route::get('/',[IndexController::class, 'index']);

//Route::resource('ajax-posts', 'ajaxcrud\AjaxPostController');


