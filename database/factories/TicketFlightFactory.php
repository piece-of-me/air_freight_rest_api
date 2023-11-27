<?php

namespace Database\Factories;

use App\Models\Seats;
use App\Models\TicketFlight;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketFlight>
 */
class TicketFlightFactory extends Factory
{
    protected $model = TicketFlight::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_no' => '',
            'flight_id' => '',
            'fare_conditions' => $this->faker->randomElement(Seats::getAllowedFareConditions()),
            'amount' => '',
        ];
    }
}
