<?php

namespace Tests\Feature\Api;

use App\Faker\AircraftProvider;
use App\Faker\FlightProvider;
use App\Models\Aircraft;
use App\Models\Airport;
use App\Models\Flight;
use Tests\TestCase;

class FlightTest extends TestCase
{
    public function test_that_flights_index_send_correct_response(): void
    {
        $flight = Flight::factory()->create();

        $response = $this->get('/api/flights');
        $response
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'flight_id',
                        'flight_no',
                        'scheduled_departure',
                        'scheduled_arrival',
                        'status',
                    ],
                ],
            ]);

        $response = $this->get('/api/flights?' . http_build_query([
                'flight_no' => $flight->flight_no,
                'scheduled_departure' => $flight->scheduled_departure,
                'scheduled_arrival' => $flight->scheduled_arrival,
                'departure_airport' => $flight->departure_airport,
                'arrival_airport' => $flight->arrival_airport,
                'status' => $flight->status,
            ])
        );

        $response
            ->assertOk()
            ->assertJsonFragment([
                'flight_id' => $flight->flight_id,
                'flight_no' => $flight->flight_no,
                'scheduled_departure' => $flight->scheduled_departure,
                'scheduled_arrival' => $flight->scheduled_arrival,
                'status' => $flight->status,
            ]);
    }

    public function test_that_flight_store_has_correct_validation(): void
    {
        $this->withHeader('Authorization', $this->getBearerToken());

        $response = $this->post('/api/flights');
        $response
            ->assertUnprocessable()
            ->assertInvalid([
                'scheduled_departure' => 'Поле "scheduled departure" должно присутствовать',
                'scheduled_arrival' => 'Поле "scheduled arrival" должно присутствовать',
                'departure_airport' => 'Поле "departure airport" должно присутствовать',
                'arrival_airport' => 'Поле "arrival airport" должно присутствовать',
                'status' => 'Поле "status" должно присутствовать',
                'aircraft_code' => 'Поле "aircraft code" должно присутствовать',
            ]);

        $flight = Flight::factory()->make();
        $departureAirport = Airport::factory()->make();
        $aircraft = Aircraft::factory()->make();
        $response = $this->post('/api/flights', [
            'scheduled_departure' => $flight->scheduled_arrival,
            'scheduled_arrival' => $flight->scheduled_departure,
            'departure_airport' => $departureAirport->airport_code,
            'arrival_airport' => $departureAirport->airport_code,
            'status' => 'Incorrect status',
            'aircraft_code' => $aircraft->aircraft_code,
        ]);

        $response
            ->assertUnprocessable()
            ->assertInvalid([
                'scheduled_arrival' => 'Дата в поле "scheduled arrival" должно быть больше даты в поле "scheduled_departure"',
                'departure_airport' => 'Поле "departure airport" должно существовать в базе данных',
                'arrival_airport' => [
                    'Поле "arrival airport" должно существовать в базе данных',
                    'Невозможно указать аэропорт вылета в качестве аэропорта прибытия',
                ],
                'status' => 'Поле "status" должно быть одним из возможных вариантов',
                'aircraft_code' => 'Поле "aircraft code" должно существовать в базе данных',
            ]);
    }

    public function test_that_flights_is_created_successfully(): void
    {
        $flight = Flight::factory()->make();
        $response = $this->withHeader('Authorization', $this->getBearerToken())->post('/api/flights', [
            'scheduled_departure' => $flight->scheduled_departure,
            'scheduled_arrival' => $flight->scheduled_arrival,
            'departure_airport' => $flight->departure_airport,
            'arrival_airport' => $flight->arrival_airport,
            'status' => $flight->status,
            'aircraft_code' => $flight->aircraft_code,
        ]);

        $response
            ->assertCreated()
            ->assertJsonStructure(['flight_no']);

        $createdFlight = Flight::firstWhere('flight_no', $response->original['flight_no']);
        $this->assertModelExists($createdFlight);
    }

    public function test_that_flight_update_has_correct_validation(): void
    {
        $this->withHeader('Authorization', $this->getBearerToken());
        $this->faker->addProvider(new AircraftProvider($this->faker));

        $flight = Flight::factory()->create();
        $response = $this->patch('/api/flights/' . $flight->flight_id);
        $response->assertUnprocessable()
            ->assertInvalid([
                'status' => 'Необходимо передать хотя бы один параметр',
                'aircraft_code' => 'Необходимо передать хотя бы один параметр',
                'actual_departure' => 'Необходимо передать хотя бы один параметр',
                'actual_arrival' => 'Необходимо передать хотя бы один параметр',
            ]);

        $response = $this->patch('/api/flights/' . $flight->flight_id, [
            'status' => 'Incorrect status',
            'aircraft_code' => $this->faker->aircraftCode(),
        ]);
        $response
            ->assertUnprocessable()
            ->assertInvalid([
                'status' => 'Поле "status" должно быть одним из возможных вариантов',
                'aircraft_code' => 'Поле "aircraft code" должно существовать в базе данных',
            ]);
    }

    public function test_that_flights_is_updated_successfully(): void
    {
        $flight = Flight::factory()->create();

        $response = $this->patch('/api/flights/' . $flight->flight_id);
        $response
            ->assertUnauthorized()
            ->assertJson(['message' => 'Unauthenticated.']);

        $this->withHeader('Authorization', $this->getBearerToken());

        $response = $this->patch('/api/flights/' . $this->faker->numberBetween(100, 1000));
        $response->assertNotFound();

        $aircraft = Aircraft::factory()->create();
        $this->faker->addProvider(new FlightProvider($this->faker));
        [, , $actualDeparture, $actualArrival] = $this->faker->scheduledAndActual();
        $response = $this->patch('/api/flights/' . $flight->flight_id, [
            'status' => $this->faker->status(),
            'aircraft_code' => $aircraft->aircraft_code,
            'actual_departure' => $actualDeparture,
            'actual_arrival' => $actualArrival,
        ]);
        $response->assertOk();
        $this->assertModelExists($flight->refresh());
    }

    public function test_that_receiving_flight_tickets_works_correctly(): void
    {
        $flight = Flight::factory()->create();
        $response = $this->get('/api/flights/' . $flight->flight_id . '/tickets');
        $response
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'ticket_no',
                        'passenger_id',
                        'passenger_name',
                        'contact_data' => [
                            'email?',
                            'phone?',
                        ],
                        'booking' => [
                            'book_date',
                            'total_amount'
                        ],
                    ],
                ],
            ]);
    }
}
