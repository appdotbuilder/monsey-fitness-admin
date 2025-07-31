<?php

namespace Database\Factories;

use App\Models\ClientMembership;
use App\Models\Client;
use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClientMembership>
 */
class ClientMembershipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\ClientMembership>
     */
    protected $model = ClientMembership::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-6 months', 'now');
        $membership = Membership::factory()->create();
        $endDate = (clone $startDate)->modify("+{$membership->duration_months} months");

        return [
            'client_id' => Client::factory(),
            'membership_id' => $membership->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'amount_paid' => $membership->price,
            'status' => $this->faker->randomElement(['active', 'expired', 'cancelled']),
        ];
    }
}