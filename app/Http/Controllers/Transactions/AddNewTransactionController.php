<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\AddNewTransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\{RedirectResponse};
use Illuminate\Support\Arr;

class AddNewTransactionController extends Controller
{
    public function __invoke(AddNewTransactionRequest $request): RedirectResponse
    {
        try {
            $user = getLoggedUser();
            $attr = Arr::add($request->validated(), 'user_id', $user['id']);

            Transaction::create($attr);

            return redirect()->route('transactions.index');
        } catch (\Exception $e) {
            return redirect()->route('transactions.index');
        }
    }
}
