<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount};

it('should be add new transaction', function () {
    $user = User::factory()->create();
    actingAs($user);

    $response = $this->post(route('transactions.store'), [
        'type'           => 'credit',
        'amount'         => 1000,
        'transaction_at' => '2024-10-10',
        'description'    => 'Test transaction',
        'observation'    => 'Test observation',
    ]);

    assertDatabaseCount('transactions', 1);
    $response->assertStatus(\Symfony\Component\HttpFoundation\Response::HTTP_CREATED);
});
