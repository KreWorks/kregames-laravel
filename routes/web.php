<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JamController;
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
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('login', [AdminController::class, 'login'])->name('login');
    Route::post('authenticate', [AdminController::class, 'authenticate'])->name('authenticate'); 
    Route::get('registration', [AdminController::class, 'registration'])->name('registration');
    Route::post('register', [AdminController::class, 'register'])->name('register'); 
    Route::get('logout', [AdminController::class, 'logout'])->name('logout');
    Route::resource('jams', JamController::class);
});

/*
Route::get('/admin/games', [GameController::class, 'admin']);

Route::get('/admin/belepes', [AdminController::class, 'login'])->name('admin/belepes');
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin/login');
Route::post('/admin/authenticate', [AdminController::class, 'authenticate'])->name('/admin/authenticate');
*/
Route::get('/{slug}', [IndexController::class, 'game']);

Route::get('/',[IndexController::class, 'index']);

//Route::resource('ajax-posts', 'ajaxcrud\AjaxPostController');

/*
Route::resources([
    'photos' => PhotoController::class,
]);

GET	/photos	index	photos.index
GET	/photos/create	create	photos.create
POST	/photos	store	photos.store
GET	/photos/{photo}	show	photos.show
GET	/photos/{photo}/edit	edit	photos.edit
PUT/PATCH	/photos/{photo}	update	photos.update
DELETE	/photos/{photo}	destroy	photos.destroy
*/
