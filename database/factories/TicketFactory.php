<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_no' => $this->faker->unique()->numerify('#############'),
            'book_ref' => '',
            'passenger_id' => $this->faker->numerify('#### ######'),
            'passenger_name' => $this->faker->firstName . ' ' . $this->faker->lastName,
            'contact_data' => json_encode([
                'email' => $this->faker->email,
                'phone' => $this->faker->phoneNumber,
            ]),
        ];
    }
}
