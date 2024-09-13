<?php

use App\Models\{Transaction, User};

use function Pest\Laravel\{actingAs, assertDatabaseMissing};

it('should be return success when remove transaction', function () {
    $user        = User::factory()->create();
    $transaction = Transaction::factory()->create();
    actingAs($user);

    $response = $this->delete(route('transactions.destroy', $transaction));

    assertDatabaseMissing('transactions', [
        $transaction->id,
    ]);

    $response->assertRedirect();
});
