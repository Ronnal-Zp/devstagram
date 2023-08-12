<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
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
    return view('principal');
});


// ============= REGISTER =============
Route::get(  '/register', [RegisterController::class, 'index'])->name('register');
Route::post( '/register', [RegisterController::class, 'store']);


// ============== LOGIN ==============
Route::get(  '/login', [LoginController::class, 'index'])->name('login');
Route::post( '/login', [LoginController::class, 'store']);
Route::post( '/logout', [LogoutController::class, 'store'])->name('logout');


// ============== PERFIL ==============
Route::get( '/{user:username}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post( '/{user:username}/store', [ProfileController::class, 'store'])->name('profile.store');


// ============== POSTS ==============
Route::get( '/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get( '/{user:username}/post/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get( '/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::delete('/posts/destroy/{post}', [PostController::class, 'destroy'])->name('posts.destroy');


// ============== LIKE ==============
Route::post( '/posts/{post}/like/store', [LikeController::class, 'store'])->name('posts.like.store');
Route::delete( '/posts/{post}/like/destroy', [LikeController::class, 'destroy'])->name('posts.like.destroy');


// ============= COMMENT =============
Route::post( '/posts/comment/store/{post}', [CommentController::class, 'store'])->name('comments.store');


// ============== IMAGE ==============
Route::post( '/image/store', [ImageController::class, 'store'])->name('image.store');

