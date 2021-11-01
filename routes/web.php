<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\IndexController;

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

Route::get('/admin/games', [GameController::class, 'admin']);


Route::get('/admin/games', [GameController::class, 'admin']);
Auth::routes();


Route::get('admin/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin/login');
