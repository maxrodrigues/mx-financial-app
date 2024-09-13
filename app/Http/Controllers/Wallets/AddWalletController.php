<?php

namespace App\Http\Controllers\Wallets;

use App\Http\Controllers\Controller;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\Auth;

class AddWalletController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
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
