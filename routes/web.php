<?php

use App\Http\Controllers\Card\{AddNewCardController, CardController};
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Transactions\{AddNewTransactionController, TransactionController, UpdateTransactionController};
use App\Http\Controllers\Wallets\{AddWalletController, UpdateWalletController, WalletController};
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
        Route::get('/', [WalletController::class, 'index'])->name('index');
        Route::post('/', AddWalletController::class)->name('store');
        Route::put('/{wallet}', UpdateWalletController::class)->name('update');
    });

    Route::group(['prefix' => 'card', 'as' => 'card.'], function () {
        Route::get('/', [CardController::class, 'index'])->name('index');
        Route::post('/', AddNewCardController::class)->name('store');
    });
});

require __DIR__ . '/auth.php';
