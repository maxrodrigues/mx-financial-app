<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

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
