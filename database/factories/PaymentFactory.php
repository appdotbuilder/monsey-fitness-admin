<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Payment>
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['pending', 'completed', 'failed', 'refunded']);
        
        return [
            'client_id' => Client::factory(),
            'amount' => $this->faker->randomFloat(2, 25, 500),
            'type' => $this->faker->randomElement(['membership', 'session', 'package', 'other']),
            'method' => $this->faker->randomElement(['cash', 'card', 'bank_transfer', 'online']),
            'status' => $status,
            'transaction_id' => $status === 'completed' ? $this->faker->uuid() : null,
            'gateway' => $this->faker->optional(0.6)->randomElement(['cardknox', 'sola', 'stripe']),
            'notes' => $this->faker->optional(0.3)->sentence(),
            'processed_at' => $status === 'completed' ? $this->faker->dateTimeBetween('-1 month', 'now') : null,
        ];
    }

    /**
     * Indicate that the payment is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'transaction_id' => $this->faker->uuid(),
            'processed_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ]);
    }
}