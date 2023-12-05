<?php

namespace Tests\Feature\Api;

use App\Faker\AirportProvider;
use App\Models\Airport;
use Tests\TestCase;

class AirportTest extends TestCase
{
    public function test_that_airports_index_send_correct_response(): void
    {
        $airport = Airport::factory(5)->create()->first();

        $response = $this->get('/api/airports');
        $response
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'code',
                        'name',
                        'city',
                        'longitude',
                        'latitude',
                        'timezone',
                    ],
                ]
            ]);

        $response = $this->get('/api/airports?' . http_build_query([
                'airport_code' => $airport->airport_code,
                'airport_name' => $airport->airport_name,
                'city' => $airport->city,
                'timezone' => $airport->timezone,
            ])
        );
        $response
            ->assertOk()
            ->assertJsonFragment([
                'code' => $airport->airport_code,
                'name' => $airport->airport_name,
                'city' => $airport->city,
                'timezone' => $airport->timezone,
            ]);
    }

    public function test_that_airport_store_has_correct_validation(): void
    {
        $response = $this->withHeader('Authorization', $this->getBearerToken())->post('/api/airports');
        $response
            ->assertUnprocessable()
            ->assertInvalid([
                'code' => 'Поле "code" должно присутствовать',
                'name' => 'Поле "name" должно присутствовать',
                'city' => 'Поле "city" должно присутствовать',
                'longitude' => 'Поле "longitude" должно присутствовать',
                'latitude' => 'Поле "latitude" должно присутствовать',
                'timezone' => 'Поле "timezone" должно присутствовать',
            ]);

        $airport = Airport::factory()->create();

        $response = $this->withHeader('Authorization', $this->getBearerToken())->post('/api/airports', [
            'code' => $airport->airport_code,
            'name' => str_repeat('a', 101),
            'city' => str_repeat('a', 101),
            'longitude' => str_repeat('a', 21),
            'latitude' => str_repeat('a', 21),
            'timezone' => str_repeat('a', 31),
        ]);
        $response
            ->assertUnprocessable()
            ->assertInvalid([
                'code' => 'Аэропорт с кодом ' . $airport->airport_code . ' уже существует',
                'name' => 'Поле "name" не должно быть длиннее 100 символов',
                'city' => 'Поле "city" не должно быть длиннее 100 символов',
                'longitude' => 'Поле "longitude" не должно быть длиннее 20 символов',
                'latitude' => 'Поле "latitude" не должно быть длиннее 20 символов',
                'timezone' => 'Поле "timezone" не должно быть длиннее 30 символов',
            ]);
    }

    public function test_that_airports_is_created_successfully(): void
    {
        $airport = Airport::factory()->make();
        $response = $this->withHeader('Authorization', $this->getBearerToken())->post('/api/airports', [
            'code' => $airport->airport_code,
            'name' => $airport->airport_name,
            'city' => $airport->city,
            'longitude' => (string)$airport->longitude,
            'latitude' => (string)$airport->latitude,
            'timezone' => $airport->timezone,
        ]);

        $response->assertCreated();
        $this->assertModelExists($airport);
    }

    public function test_that_airport_search_by_code_is_correct(): void
    {
        $this->faker->addProvider(new AirportProvider($this->faker));

        $response = $this->get('/api/airports/' . $this->faker->airportCode());
        $response->assertNotFound();

        $airport = Airport::factory()->create();
        $response = $this->get('/api/airports/' . $airport->airport_code);

        $response
            ->assertOk()
            ->assertJsonFragment([
                'code' => $airport->airport_code,
                'name' => $airport->airport_name,
                'city' => $airport->city,
                'longitude' => $airport->longitude,
                'latitude' => $airport->latitude,
                'timezone' => $airport->timezone,
            ]);
    }

    public function test_that_airport_update_has_correct_validation(): void
    {
        $airport = Airport::factory()->create();
        $response = $this->withHeader('Authorization', $this->getBearerToken())->patch('/api/airports/' . $airport->airport_code, [
            'name' => 1,
            'city' => 1,
            'longitude' => 1,
            'latitude' => 1,
            'timezone' => 1,
        ]);
        $response
            ->assertUnprocessable()
            ->assertInvalid([
                'name' => 'Поле "name" должно быть строкой',
                'city' => 'Поле "city" должно быть строкой',
                'longitude' => 'Поле "longitude" должно быть строкой',
                'latitude' => 'Поле "latitude" должно быть строкой',
                'timezone' => 'Поле "timezone" должно быть строкой',
            ]);

        $response = $this->withHeader('Authorization', $this->getBearerToken())->patch('/api/airports/' . $airport->airport_code, [
            'name' => str_repeat('a', 101),
            'city' => str_repeat('a', 101),
            'longitude' => str_repeat('a', 21),
            'latitude' => str_repeat('a', 21),
            'timezone' => str_repeat('a', 31),
        ]);
        $response
            ->assertUnprocessable()
            ->assertInvalid([
                'name' => 'Поле "name" не должно быть длиннее 100 символов',
                'city' => 'Поле "city" не должно быть длиннее 100 символов',
                'longitude' => 'Поле "longitude" не должно быть длиннее 20 символов',
                'latitude' => 'Поле "latitude" не должно быть длиннее 20 символов',
                'timezone' => 'Поле "timezone" не должно быть длиннее 30 символов',
            ]);
    }

    public function test_that_airports_is_updated_successfully(): void
    {
        $this->faker->addProvider(new AirportProvider($this->faker));

        $response = $this->patch('/api/airports/' . $this->faker->airportCode());
        $response->assertUnauthorized();

        $response = $this->withHeader('Authorization', $this->getBearerToken())->patch('/api/airports/' . $this->faker->airportCode());
        $response->assertNotFound();

        $airport = Airport::factory()->create();
        $response = $this->withHeader('Authorization', $this->getBearerToken())->patch('/api/airports/' . $airport->airport_code, [
            'name' => $this->faker->airportName(),
            'city' => $this->faker->city(),
            'longitude' => (string)$this->faker->longitude(),
            'latitude' => (string)$this->faker->latitude(),
            'timezone' => $this->faker->timezone(),
        ]);

        $response->assertOk();
        $this->assertModelExists($airport->refresh());
    }
}
