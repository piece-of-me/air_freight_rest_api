<?php

namespace Database\Factories;

use App\Faker\SeatsProvider;
use App\Models\Seats;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seats>
 */
class SeatsFactory extends Factory
{
    protected $model = Seats::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new SeatsProvider($this->faker));
        return [
            'aircraft_code' => '',
            'seat_no' => $this->faker->seatNo(),
            'fare_conditions' => $this->faker->fareCondition(),
        ];
    }
}
