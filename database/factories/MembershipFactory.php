<?php

namespace Database\Factories;

use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membership>
 */
class MembershipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Membership>
     */
    protected $model = Membership::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $membershipTypes = [
            ['name' => 'Basic Monthly', 'duration' => 1, 'price_range' => [29, 59]],
            ['name' => 'Premium Monthly', 'duration' => 1, 'price_range' => [59, 99]],
            ['name' => 'Annual Basic', 'duration' => 12, 'price_range' => [299, 599]],
            ['name' => 'VIP Annual', 'duration' => 12, 'price_range' => [799, 1299]],
        ];

        $type = $this->faker->randomElement($membershipTypes);

        return [
            'name' => $type['name'],
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, $type['price_range'][0], $type['price_range'][1]),
            'duration_months' => $type['duration'],
            'is_recurring' => $type['duration'] === 1,
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
        ];
    }
}