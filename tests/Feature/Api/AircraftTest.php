<?php

namespace Tests\Feature\Api;

use App\Faker\AircraftProvider;
use App\Models\Aircraft;
use Tests\TestCase;

class AircraftTest extends TestCase
{
    public function test_that_aircrafts_index_send_correct_response(): void
    {
        Aircraft::factory(5)->create();
        $this->get('/api/aircrafts')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'code',
                        'model',
                        'range',
                        'seats' => [
                            '*' => [
                                'seat_id',
                                'seat_no',
                                'fare_conditions',
                            ]
                        ],
                    ],
                ],
            ]);
    }

    public function test_that_aircrafts_store_has_correct_validation(): void
    {
        $this->withHeader('Authorization', $this->getBearerToken());

        $this->post('/api/aircrafts')
            ->assertUnprocessable()
            ->assertInvalid([
                'code' => 'Поле "code" должно присутствовать',
                'model' => 'Поле "model" должно присутствовать',
                'range' => 'Поле "range" должно присутствовать',
            ]);

        $this->post('/api/aircrafts', [
            'code' => 1,
            'model' => 1,
            'range' => 'string',
        ])
            ->assertUnprocessable()
            ->assertInvalid([
                'code' => 'Поле "code" должно быть строкой',
                'model' => 'Поле "model" должно быть строкой',
                'range' => 'Поле "range" должно быть числом',
            ]);

        $this->post('/api/aircrafts', [
            'code' => str_repeat('a', 4),
            'model' => str_repeat('a', 51),
            'range' => 0,
        ])
            ->assertUnprocessable()
            ->assertInvalid([
                'code' => 'Поле "code" не должно быть длиннее 3 символов',
                'model' => 'Поле "model" не должно быть длиннее 50 символов',
                'range' => 'Поле "range" должно быть больше 0',
            ]);

        $aircraft = Aircraft::factory()->create();
        $this->post('/api/aircrafts', [
            'code' => $aircraft->aircraft_code,
            'model' => $aircraft->model,
            'range' => $aircraft->range,
        ])
            ->assertUnprocessable()
            ->assertInvalid([
                'code' => 'Судно с кодом ' . $aircraft->aircraft_code . ' уже существует',
            ]);
    }

    public function test_that_aircrafts_is_created_successfully(): void
    {
        $this->withHeader('Authorization', $this->getBearerToken());
        $aircraft = Aircraft::factory()->make();
        $this->post('/api/aircrafts', [
            'code' => $aircraft->aircraft_code,
            'model' => $aircraft->model,
            'range' => $aircraft->range,
        ])
            ->assertCreated();
        $this->assertModelExists(Aircraft::firstWhere('aircraft_code', $aircraft->aircraft_code));
    }

    public function test_that_aircrafts_update_has_correct_validation(): void
    {
        $aircraft = Aircraft::factory()->create();
        define('PATH', '/api/aircrafts/' . $aircraft->aircraft_code);

        $this->withHeader('Authorization', $this->getBearerToken());

        $this->patch(PATH)
            ->assertUnprocessable()
            ->assertInvalid([
                'model' => 'Необходимо передать хотя бы одно из указанных полей: model, range',
                'range' => 'Необходимо передать хотя бы одно из указанных полей: model, range',
            ]);

        $this->patch(PATH, [
            'model' => 1,
            'range' => 'string',
        ])
            ->assertUnprocessable()
            ->assertInvalid([
                'model' => 'Поле "model" должно быть строкой',
                'range' => 'Поле "range" должно быть числом',
            ]);

        $this->patch(PATH, [
            'model' => str_repeat('a', 51),
            'range' => 0
        ])
            ->assertUnprocessable()
            ->assertInvalid([
                'model' => 'Поле "model" не должно быть длиннее 50 символов',
                'range' => 'Поле "range" должно быть больше 0',
            ]);
    }

    public function test_that_aircrafts_is_updated_successfully(): void
    {
        $this->faker->addProvider(new AircraftProvider($this->faker));

        $this->patch('/api/aircrafts/' . $this->faker->aircraftCode())
            ->assertUnauthorized()
            ->assertJson([
                'message' => 'Unauthenticated.'
            ]);

        $this->withHeader('Authorization', $this->getBearerToken());

        $this->patch('/api/aircrafts/' . $this->faker->aircraftCode())
            ->assertNotFound();

        $aircraft = Aircraft::factory()->create();
        $this->patch('/api/aircrafts/' . $aircraft->aircraft_code, [
            'model' => $this->faker->model(),
            'range' => $this->faker->range(),
        ])
            ->assertOk();
        $this->assertModelExists($aircraft->refresh());
    }

    public function test_that_getting_aircraft_works_correctly(): void
    {
        $aircraft = Aircraft::factory()->create();

        $this->get('/api/aircrafts/' . $aircraft->aircraft_code)
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'code',
                    'model',
                    'range',
                    'seats' => [
                        '*' => [
                            'seat_id',
                            'seat_no',
                            'fare_conditions',
                        ],
                    ],
                ],
            ])
            ->assertJsonFragment([
                'code' => $aircraft->aircraft_code,
                'model' => $aircraft->model,
                'range' => $aircraft->range,
            ]);
    }

    public function test_that_receiving_total_profit_of_aircraft_is_correct(): void
    {
        $aircraft = Aircraft::factory()->create();
    }
}
