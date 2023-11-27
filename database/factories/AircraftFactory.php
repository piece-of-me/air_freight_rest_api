<?php

namespace Database\Factories;

use App\Faker\AircraftProvider;
use App\Models\Aircraft;
use App\Models\Seats;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aircraft>
 */
class AircraftFactory extends Factory
{
    protected $model = Aircraft::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new AircraftProvider($this->faker));
        return [
            'aircraft_code' => $this->faker->aircraftCode(),
            'model' => $this->faker->model(),
            'range' => $this->faker->range(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Aircraft $aircraft) {
            Seats::factory($this->faker->numberBetween(10, 50), ['aircraft_code' => $aircraft->aircraft_code])->create();
        });
    }
}
