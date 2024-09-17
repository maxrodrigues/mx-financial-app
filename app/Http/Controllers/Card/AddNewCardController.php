<?php

namespace App\Http\Controllers\Card;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Models\Card;
use Illuminate\Http\{RedirectResponse};
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class AddNewCardController extends Controller
{
    public function __invoke(CardRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $attr = Arr::add($request->validated(), 'user_id', $user->id);

        Card::create($attr);

        return redirect()->route('card.index');
    }
}
