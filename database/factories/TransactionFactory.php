<?php

namespace Database\Factories;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1000,2000),
            'amount' => fake()->numberBetween(-1000000000000, 1000000000000),
            'reference_id' => time() + fake()->numberBetween(1000000,100000000),
            'created_at' => fake()->dateTimeBetween(
                Carbon::now()->subMonths(6)->toDateTimeString(),
                Carbon::now()->toDateTimeString()
            )
        ];
    }
}
