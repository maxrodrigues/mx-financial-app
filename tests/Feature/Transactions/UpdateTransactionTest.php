<?php

use App\Models\{Transaction, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas};

it('should be updated transaction', function () {
    $user = User::factory()->create();
    actingAs($user);

    $transaction = Transaction::factory()->create();

    $response = $this->put(route('transactions.update', ['transaction' => $transaction->id]), [
        'amount'         => 999,
        'type'           => $transaction->type,
        'transaction_at' => $transaction->transaction_at,
        'description'    => $transaction->description,
        'observation'    => $transaction->observation,
    ]);

    $response->assertRedirect();
    assertDatabaseHas('transactions', [
        'amount'         => 999,
        'type'           => $transaction->type,
        'transaction_at' => $transaction->transaction_at,
        'description'    => $transaction->description,
        'observation'    => $transaction->observation,
    ]);
});
