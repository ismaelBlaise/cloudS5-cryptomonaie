<?php

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
    return view('auth.login');
});


use App\Http\Controllers\CompteController;

Route::prefix('/auth')->group(function () {
    Route::get('/login', [CompteController::class, 'index'])->name('login');
    Route::post('/login', [CompteController::class, 'authenticate'])->name('login.authenticate');
    Route::get('/register', [CompteController::class, 'create'])->name('register');
    Route::post('/register', [CompteController::class, 'store'])->name('register.store');
    Route::get('/logout', [CompteController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [CompteController::class, 'dashboard'])->name('dashboard');
    Route::get('/validate-pin', [CompteController::class, 'validatePin'])->name('validatepin');
    Route::get('/validate-account', [CompteController::class, 'validateCompte'])->name('validatecompte');
});


