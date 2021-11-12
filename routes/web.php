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

Route::get('admin', [AdminController::class, 'dashboard'])->name('admin');
Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin/dashboard'); 
Route::get('admin/login', [AdminController::class, 'index'])->name('admin/login');
Route::post('admin/custom-login', [AdminController::class, 'customLogin'])->name('admin/custom-login'); 
Route::get('admin/registration', [AdminController::class, 'registration'])->name('admin/register-user');
Route::post('admin/custom-registration', [AdminController::class, 'customRegistration'])->name('admin/custom-register'); 
Route::get('admin/signout', [AdminController::class, 'signOut'])->name('admin/signout');


/*
Route::get('/admin/games', [GameController::class, 'admin']);

Route::get('/admin/belepes', [AdminController::class, 'login'])->name('admin/belepes');
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin/login');
Route::post('/admin/authenticate', [AdminController::class, 'authenticate'])->name('/admin/authenticate');
*/
Route::get('/{slug}', [IndexController::class, 'game']);

Route::get('/',[IndexController::class, 'index']);

//Route::resource('ajax-posts', 'ajaxcrud\AjaxPostController');


