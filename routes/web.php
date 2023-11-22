<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

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
    return view('welcome');
});



Route::middleware('auth')->group(function () {

    // Profile Route
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     // Post Route
     Route::get('/home', [PostController::class, 'index'])->name('home');
     Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
     Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
     Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
     Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.delete');
});

require __DIR__.'/auth.php';
