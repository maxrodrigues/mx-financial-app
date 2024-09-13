<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

it('should redirect when registering a new wallet', function () {
    $user = User::factory()->create();
    actingAs($user);

    $attributes = [
        'name'      => 'Wallet Test',
        'balance'   => 0,
        'is_active' => true,
    ];

    $this->post(route('wallets.store'), $attributes)
        ->assertRedirect(route('wallets.index'));

    assertDatabaseHas('wallets', $attributes);
});

it('should return error when required fields are missing', function () {
    $user = User::factory()->create();
    actingAs($user);

    $this->post(route('wallets.store'), [])
        ->assertSessionHasErrors([
            'name',
        ]);
});

it('should be show message error when wallet name has minimum 5 characters', function () {
    $user = User::factory()->create();
    actingAs($user);

    $attributes = [
        'name' => 'Test',
    ];

    $this->post(route('wallets.store'), $attributes)
        ->assertSessionHasErrors([
            'name' => __('validation.min.string', ['attribute' => 'name', 'min' => 5]),
        ]);
});
