<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\RegisterUserController;

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
    return view('auth.login');
});

Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store']);

// Login
Route::get('/login', [LoginUserController::class, 'loginPage'])->name('login');
Route::post('/login', [LoginUserController::class, 'login']);
Route::post('/logout', [LoginUserController::class, 'logout'])->name('logout');




Route::middleware(['auth'])->group(function () {
    // Home Route
    // Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Profile Route
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile{id}', [ProfileController::class, 'update'])->name('profile.update');

    // Post Route
    Route::get('/home', [PostController::class, 'index'])->name('home');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.delete');


});


