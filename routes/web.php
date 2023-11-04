<?php

use Illuminate\Support\Facades\Route;
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

// Route::get('/login', function () {
//     return view('auth.login');
// });
// Route::get('/register', function () {
//     return view('auth.register');
// });
Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store']);

// Login
Route::get('/login', [LoginUserController::class, 'loginPage'])->name('login');
Route::post('/login', [LoginUserController::class, 'login']);
Route::post('/logout', [LoginUserController::class, 'logout'])->name('logout');




Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('pages.home');
    });
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile{id}', [ProfileController::class, 'update'])->name('profile.update');

});


