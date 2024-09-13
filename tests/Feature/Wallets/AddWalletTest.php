<?php

it('should redirect when registering a new wallet', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $attributes = [
        'name'      => 'Wallet Test',
        'balance'   => 0,
        'is_active' => true,
    ];

    $this->post(route('wallets.store'), $attributes)
        ->assertRedirect(route('wallets.index'));

    \Pest\Laravel\assertDatabaseHas('wallets', $attributes);
});
