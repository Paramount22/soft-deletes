<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::get('/',  [PostController::class, 'index'])->name('posts');
/*POSTS*/
Route::get('post/restore/one/{post}', [PostController::class, 'restore'])->name('posts.restore');
Route::get('posts/restore_all', [PostController::class, 'restoreAll'])->name('posts.restore_all');
Route::post('posts/{id}/force_delete', [PostController::class, 'forceDelete'])->name('posts.force_delete');
Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('posts/store', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::delete('post/{post}', [PostController::class, 'delete'])->name('posts.delete');


/*USERS*/
Route::get('user/restore/one/{user}', [UserController::class, 'restore'])->name('users.restore');
Route::get('users/restore_all', [UserController::class, 'restoreAll'])->name('users.restore_all');
Route::post('users/{id}/force_delete', [UserController::class, 'forceDelete'])->name('users.force_delete');

Route::resource('users', UserController::class);


Route::get('welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
