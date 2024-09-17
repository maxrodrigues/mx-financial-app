<?php

it('should be create a new credit card', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    $this->post(route('card.store'), [
        'name'  => 'Card',
        'bank'  => 'Card Bank',
        'limit' => 100000,
    ])
        ->assertRedirect(route('card.index'));

    \Pest\Laravel\assertDatabaseCount('cards', 1);
});
