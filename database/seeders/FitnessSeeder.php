<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Trainer;
use App\Models\Session;
use App\Models\Payment;
use App\Models\Membership;
use Illuminate\Database\Seeder;

class FitnessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create memberships
        $memberships = [
            [
                'name' => 'Basic Monthly',
                'description' => 'Access to gym facilities and basic classes',
                'price' => 49.99,
                'duration_months' => 1,
                'is_recurring' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Premium Monthly',
                'description' => 'Full access including personal training sessions',
                'price' => 99.99,
                'duration_months' => 1,
                'is_recurring' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Annual Basic',
                'description' => 'Full year access with 2 months free',
                'price' => 499.99,
                'duration_months' => 12,
                'is_recurring' => false,
                'is_active' => true,
            ],
            [
                'name' => 'VIP Annual',
                'description' => 'All-inclusive with unlimited personal training',
                'price' => 1199.99,
                'duration_months' => 12,
                'is_recurring' => false,
                'is_active' => true,
            ],
        ];

        foreach ($memberships as $membership) {
            Membership::create($membership);
        }

        // Create trainers
        Trainer::factory(12)->active()->create();
        Trainer::factory(3)->create(['status' => 'inactive']);

        // Create clients
        Client::factory(50)->active()->create();
        Client::factory(15)->create(['status' => 'inactive']);
        Client::factory(8)->create(['status' => 'follow-up']);

        // Create sessions for today and upcoming
        $clients = Client::active()->take(20)->get();
        $trainers = Trainer::active()->get();

        foreach ($clients as $client) {
            // Create some past sessions
            Session::factory(random_int(2, 8))->create([
                'client_id' => $client->id,
                'trainer_id' => $trainers->random()->id,
                'status' => 'completed',
                'scheduled_at' => fake()->dateTimeBetween('-3 months', '-1 day'),
            ]);

            // Create today's sessions
            if (random_int(1, 100) <= 30) { // 30% chance of having a session today
                Session::factory()->today()->scheduled()->create([
                    'client_id' => $client->id,
                    'trainer_id' => $trainers->random()->id,
                ]);
            }

            // Create upcoming sessions
            Session::factory(random_int(1, 4))->scheduled()->create([
                'client_id' => $client->id,
                'trainer_id' => $trainers->random()->id,
            ]);
        }

        // Create payments
        foreach ($clients as $client) {
            // Create some completed payments
            Payment::factory(random_int(3, 12))->completed()->create([
                'client_id' => $client->id,
            ]);

            // Occasionally create a pending payment
            if (random_int(1, 100) <= 20) { // 20% chance
                Payment::factory()->create([
                    'client_id' => $client->id,
                    'status' => 'pending',
                ]);
            }
        }
    }
}