<?php

namespace Database\Seeders;

use App\Helpers\CSVFileReader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        $reader = new CSVFileReader(base_path('/database/csv/flights.csv'));
        foreach ($reader->chunk() as $chunk) {
            DB::table('flights')->insert(array_map(fn($row) => [
                'flight_id' => $row[0],
                'flight_no' => $row[1],
                'scheduled_departure' => $row[2],
                'scheduled_arrival' => $row[3],
                'departure_airport' => $row[4],
                'arrival_airport' => $row[5],
                'status' => $row[6],
                'aircraft_code' => $row[7],
                'actual_departure' => $row[8] === '' ? null : $row[8],
                'actual_arrival' => $row[9] === '' ? null : $row[9],
            ], $chunk));
        }
    }
}
