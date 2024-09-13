<?php

use App\Models\{User, Wallet};

use function Pest\Laravel\{actingAs, assertDatabaseHas};

it('should be update wallet name and redirect to list wallet', function () {
    $user = User::factory()->create();
    actingAs($user);
    $wallet = Wallet::factory()
        ->for($user)
        ->create();

    $attr = [
        'name' => 'update-wallet-name',
    ];

    $this->put(route('wallets.update', $wallet), $attr)
        ->assertRedirect(route('wallets.index'));

    assertDatabaseHas('wallets', ['name' => 'update-wallet-name']);
});

it('should be deactivate wallet', function () {
    $user = User::factory()->create();
    actingAs($user);
    $wallet = Wallet::factory()
        ->for($user)
        ->create();

    $attr = [
        'name'      => $wallet->name,
        'balance'   => $wallet->balance,
        'is_active' => false,
    ];

    $this->put(route('wallets.update', $wallet), $attr)
        ->assertRedirect(route('wallets.index'));

    assertDatabaseHas('wallets', ['is_active' => false]);
});

it('should be update wallet balance', function () {
    $user = User::factory()->create();
    actingAs($user);
    $wallet = Wallet::factory()
        ->for($user)
        ->create();

    $attr = [
        'name'      => $wallet->name,
        'balance'   => 9999999,
        'is_active' => $wallet->is_active,
    ];

    $this->put(route('wallets.update', $wallet), $attr)
        ->assertRedirect(route('wallets.index'));

    assertDatabaseHas('wallets', ['balance' => 9999999]);
});
