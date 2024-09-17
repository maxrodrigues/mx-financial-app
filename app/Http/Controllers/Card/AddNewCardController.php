<?php

namespace App\Http\Controllers\Card;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class AddNewCardController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $attr = Arr::add($request->all(), 'user_id', $user->id);

        Card::create($attr);

        return redirect()->route('card.index');
    }
}
