<?php

use App\Models\{Transaction, User, Wallet};

use function Pest\Laravel\{actingAs, assertDatabaseMissing};

it('should be return success when remove transaction', function () {
    $user        = User::factory()->create();
    $transaction = Transaction::factory()
        ->for(Wallet::factory()->create(['user_id' => $user->id]))
        ->create();

    actingAs($user);

    $response = $this->delete(route('transactions.destroy', $transaction));

    assertDatabaseMissing('transactions', [
        $transaction->id,
    ]);

    $response->assertRedirect();
});
