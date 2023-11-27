<?php

namespace Database\Factories;

use App\Models\Booking;
use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_ref' => $this->faker->regexify('([A-Z]|\d){6}'),
            'book_date' => DateTime::dateTimeThisDecade(),
            'total_amount' => $this->faker->randomFloat(2, 1000, 10000),
        ];
    }
}
