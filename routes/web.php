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
    Route::post('/valider-pin', [CompteController::class, 'validerPin'])->name('validerpin');
    Route::get('/validate-account', [CompteController::class, 'validateCompte'])->name('validatecompte');
});



use App\Http\Controllers\TransactionController;

Route::get('/transactions/depot', [TransactionController::class, 'depotForm'])->name('transactions.depotForm');
Route::post('/transactions/depot', [TransactionController::class, 'depot'])->name('transactions.depot');

Route::get('/transactions/vente', [TransactionController::class, 'venteForm'])->name('transactions.venteForm');
Route::post('/transactions/vente', [TransactionController::class, 'vente'])->name('transactions.vente');

Route::get('/transactions/echange', [TransactionController::class, 'echangeForm'])->name('transactions.echangeForm');
Route::post('/transactions/echange', [TransactionController::class, 'echange'])->name('transactions.echange');


Route::get('/transactions/choix', [TransactionController::class, 'choixForm'])->name('transactions.choixForm');


