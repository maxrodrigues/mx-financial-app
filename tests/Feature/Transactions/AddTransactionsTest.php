<?php

use App\Models\{User, Wallet};

use function Pest\Laravel\{actingAs, assertDatabaseCount};

it('should be add new transaction', function () {
    $user = User::factory()->create();
    actingAs($user);
    $wallet = Wallet::factory()
        ->for($user)
        ->create();

    $response = $this->post(route('transactions.store'), [
        'wallet_id'      => $wallet->id,
        'type'           => 'credit',
        'amount'         => 1000,
        'transaction_at' => '2024-10-10',
        'description'    => 'Test transaction',
        'observation'    => 'Test observation',
    ]);

    assertDatabaseCount('transactions', 1);
    $response->assertStatus(\Symfony\Component\HttpFoundation\Response::HTTP_CREATED);
});

it('should be validate attributes to store a transaction', function () {
    $user = User::factory()->create();
    actingAs($user);

    $response = $this->post(route('transactions.store'), []);

    $response->assertSessionHasErrors([
        'type',
        'amount',
        'transaction_at',
        'description',
    ]);
});

it('should transaction must belong to a wallet', function () {
    $user = User::factory()->create();
    actingAs($user);
    $wallet = Wallet::factory()
        ->for($user)
        ->create();

    $this->post(route('transactions.store'), [
        'type'           => 'credit',
        'amount'         => 1000,
        'transaction_at' => '2024-10-10',
        'description'    => 'Test transaction',
        'observation'    => 'Test observation',
    ])
        ->assertSessionHasErrors([
            'wallet_id',
        ]);

    assertDatabaseCount('transactions', 0);

    $this->post(route('transactions.store'), [
        'wallet_id'      => $wallet->id,
        'type'           => 'credit',
        'amount'         => 1000,
        'transaction_at' => '2024-10-10',
        'description'    => 'Test transaction',
        'observation'    => 'Test observation',
    ]);

    assertDatabaseCount('transactions', 1);
});
