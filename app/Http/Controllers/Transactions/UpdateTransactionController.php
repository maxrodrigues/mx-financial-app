<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\{RedirectResponse};

class UpdateTransactionController extends Controller
{
    public function __invoke(Transaction $transaction): RedirectResponse
    {
        try {
            $transaction->update(request()->all());

            return redirect()->route('transactions.index');
        } catch (Exception $e) {
            return redirect()->route('transactions.index');
        }
    }
}
