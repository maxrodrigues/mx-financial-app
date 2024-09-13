<?php

namespace App\Http\Controllers\Wallets;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wallets\AddWalletRequest;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\{RedirectResponse};

class UpdateWalletController extends Controller
{
    public function __invoke(Wallet $wallet, AddWalletRequest $request): RedirectResponse
    {
        try {
            $wallet->update($request->validated());

            return redirect()->route('wallets.index');
        } catch (Exception $e) {
            return redirect()->route('wallets.index');
        }
    }
}
