<?php

use App\Models\{Transaction, User, Wallet};

use function Pest\Laravel\{actingAs, assertDatabaseHas};

it('should be updated transaction', function () {
    $user = User::factory()->create();
    actingAs($user);
    $wallet      = Wallet::factory()->for($user)->create();
    $transaction = Transaction::factory()->for($wallet)->create();

    $response = $this->put(route('transactions.update', ['transaction' => $transaction->id]), [
        'wallet_id'      => $wallet->id,
        'amount'         => 999,
        'type'           => $transaction->type,
        'transaction_at' => $transaction->transaction_at,
        'description'    => $transaction->description,
        'observation'    => $transaction->observation,
    ]);

    $response->assertRedirect();
    assertDatabaseHas('transactions', [
        'wallet_id'      => $wallet->id,
        'amount'         => 999,
        'type'           => $transaction->type,
        'transaction_at' => $transaction->transaction_at,
        'description'    => $transaction->description,
        'observation'    => $transaction->observation,
    ]);
});
