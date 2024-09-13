<?php

namespace App\Http\Controllers\Wallets;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wallets\AddWalletRequest;
use Illuminate\Http\{RedirectResponse};
use Illuminate\Support\Facades\Auth;

class AddWalletController extends Controller
{
    public function __invoke(AddWalletRequest $request): RedirectResponse
    {
        try {
            Auth::user()
                ->wallets()
                ->create($request->all());

            return redirect()->route('wallets.index');
        } catch (\Exception $e) {
            return redirect()->route('wallets.index');
        }
    }
}
