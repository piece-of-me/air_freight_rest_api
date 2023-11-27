<?php

namespace Database\Factories;

use App\Faker\AirportProvider;
use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Airport>
 */
class AirportFactory extends Factory
{
    protected $model = Airport::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new AirportProvider($this->faker));
        return [
            'airport_code' => $this->faker->airportCode(),
            'airport_name' => $this->faker->airportName(),
            'city' => $this->faker->city(),
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
            'timezone' => $this->faker->timezone(),
        ];
    }
}
