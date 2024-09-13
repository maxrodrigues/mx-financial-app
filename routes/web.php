<?php

use App\Http\Controllers\ProfileController;
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
    Route::post('transactions', \App\Http\Controllers\Transactions\AddNewTransactionController::class)->name('transactions.store');
    Route::put('transactions/{transaction}', \App\Http\Controllers\Transactions\UpdateTransactionController::class)->name('transactions.update');
    Route::delete('transactions/{transaction}', [\App\Http\Controllers\Transactions\TransactionController::class, 'destroy'])->name('transactions.destroy');
});

require __DIR__ . '/auth.php';
