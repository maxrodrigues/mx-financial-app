<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transactions>
 */
class TransactionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description'    => $this->faker->words(4, true),
            'amount'         => $this->faker->numberBetween(100, 10000),
            'transaction_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'observation'    => $this->faker->text(),
            'type'           => $this->faker->randomElement(['debit', 'credit']),
        ];
    }
}
