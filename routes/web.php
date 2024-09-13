<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Transactions\{AddNewTransactionController, TransactionController, UpdateTransactionController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('transactions', function () {
        return 'hello world';
    })->name('transactions.index');
    Route::post('transactions', AddNewTransactionController::class)->name('transactions.store');
    Route::put('transactions/{transaction}', UpdateTransactionController::class)->name('transactions.update');
    Route::delete('transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

    Route::group(['prefix' => 'wallets', 'as' => 'wallets.'], function () {
        Route::get('/', [\App\Http\Controllers\Wallets\WalletController::class, 'index'])->name('index');
        Route::post('/', \App\Http\Controllers\Wallets\AddWalletController::class)->name('store');
    });
});

require __DIR__ . '/auth.php';
