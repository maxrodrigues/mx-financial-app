<?php

use App\Models\{Card, User, Wallet};

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
    ])
        ->assertRedirect(route('transactions.index'));

    assertDatabaseCount('transactions', 1);
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

it('should transaction must belong to card', function () {
    $user = User::factory()->create();
    $card = Card::factory()
        ->for($user)
        ->create();

    actingAs($user);

    $response = $this->post(route('transactions.store'), [
        'card_id'        => $card->id,
        'type'           => 'debit',
        'amount'         => 1000,
        'transaction_at' => '2024-10-10',
        'description'    => 'Test transaction',
        'observation'    => 'Test observation',
    ]);

    $response->assertRedirect();
    assertDatabaseCount('transactions', 1);
});

//skip test to refine writing
it('should card transaction must be only debit', function () {
    $user = User::factory()->create();
    $card = Card::factory()
        ->for($user)
        ->create();

    actingAs($user);

    $this->post(route('transactions.store'), [
        'card_id'        => $card->id,
        'type'           => 'debit',
        'amount'         => 1000,
        'transaction_at' => '2024-10-10',
        'description'    => 'Test transaction',
        'observation'    => 'Test observation',
    ]);
})->skip();
