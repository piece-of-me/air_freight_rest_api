<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\TicketFlight;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Faker\FlightProvider;
use App\Models\Aircraft;
use App\Models\Airport;
use App\Models\Booking;
use App\Models\Flight;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    protected $model = Flight::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new FlightProvider($this->faker));
        [$scheduledDeparture, $scheduledArrival, $actualDeparture, $actualArrival] = $this->faker->scheduledAndActual();
        return [
            'flight_no' => $this->faker->flightNo(),
            'scheduled_departure' => $scheduledDeparture,
            'scheduled_arrival' => $scheduledArrival,
            'departure_airport' => Airport::factory()->create()->airport_code,
            'arrival_airport' => Airport::factory()->create()->airport_code,
            'status' => $this->faker->status(),
            'aircraft_code' => Aircraft::factory()->create()->aircraft_code,
            'actual_departure' => $actualDeparture,
            'actual_arrival' => $actualArrival,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Flight $flight) {
            Booking::factory($this->faker->numberBetween(2, 10))->create()
                ->map(fn($item) => [
                    'total_amount' => $item->total_amount,
                    'ticket_no' => Ticket::factory()->create(['book_ref' => $item->book_ref])->ticket_no
                ])
                ->each(static function (array $item) use ($flight) {
                    TicketFlight::factory()->create([
                        'flight_id' => $flight->flight_id,
                        'ticket_no' => $item['ticket_no'],
                        'amount' => $item['total_amount']
                    ]);
                });

        });
    }
}
