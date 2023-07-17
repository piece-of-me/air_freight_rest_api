<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AircraftSeeder::class,
            AirportSeeder::class,
            SeatsSeeder::class,
            FlightSeeder::class,
            BookingSeeder::class,
            TicketSeeder::class,
            TicketFlightSeeder::class,
            BoardingPassSeeder::class,
        ]);
    }
}
