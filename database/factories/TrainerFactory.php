<?php

namespace Database\Factories;

use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trainer>
 */
class TrainerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Trainer>
     */
    protected $model = Trainer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specialties = [
            'Personal Training', 'Group Fitness', 'Yoga', 'Pilates', 'CrossFit',
            'Weight Training', 'Cardio', 'Nutrition Coaching', 'Sports Conditioning',
            'Rehabilitation', 'Senior Fitness', 'Youth Training'
        ];

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'specialties' => $this->faker->randomElements($specialties, random_int(1, 4)),
            'hourly_rate' => $this->faker->randomFloat(2, 25, 150),
            'commission_rate' => $this->faker->randomFloat(2, 5, 25),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the trainer is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}