<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\{RedirectResponse};

class TransactionController extends Controller
{
    public function destroy(Transaction $transaction): RedirectResponse
    {
        $transaction->delete();

        return redirect()->route('transactions.index');
    }
}
