<?php

namespace Database\Factories;

use App\Models\Session;
use App\Models\Client;
use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Session>
     */
    protected $model = Session::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['personal', 'group', 'class'];
        $type = $this->faker->randomElement($types);
        
        $titles = [
            'personal' => ['Personal Training Session', 'One-on-One Training', 'Individual Workout'],
            'group' => ['Small Group Training', 'Partner Workout', 'Group Session'],
            'class' => ['Yoga Class', 'Pilates Class', 'CrossFit Class', 'Spin Class', 'Zumba Class']
        ];

        return [
            'client_id' => Client::factory(),
            'trainer_id' => Trainer::factory(),
            'type' => $type,
            'title' => $this->faker->randomElement($titles[$type]),
            'description' => $this->faker->optional(0.7)->sentence(),
            'scheduled_at' => $this->faker->dateTimeBetween('now', '+1 month'),
            'duration_minutes' => $this->faker->randomElement([30, 45, 60, 90]),
            'price' => $this->faker->randomFloat(2, 25, 150),
            'status' => $this->faker->randomElement(['scheduled', 'completed', 'cancelled', 'no-show']),
            'notes' => $this->faker->optional(0.4)->sentence(),
        ];
    }

    /**
     * Indicate that the session is scheduled.
     */
    public function scheduled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'scheduled',
            'scheduled_at' => $this->faker->dateTimeBetween('now', '+1 month'),
        ]);
    }

    /**
     * Indicate that the session is today.
     */
    public function today(): static
    {
        return $this->state(fn (array $attributes) => [
            'scheduled_at' => $this->faker->dateTimeBetween('today', 'today +23 hours'),
        ]);
    }
}