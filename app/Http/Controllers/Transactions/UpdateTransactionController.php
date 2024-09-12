<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\UpdateRequest;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\{RedirectResponse};

class UpdateTransactionController extends Controller
{
    public function __invoke(Transaction $transaction, UpdateRequest $request): RedirectResponse
    {
        try {
            $transaction->update(
                $request->validated()
            );

            return redirect()->route('transactions.index');
        } catch (Exception $e) {
            return redirect()->route('transactions.index');
        }
    }
}
