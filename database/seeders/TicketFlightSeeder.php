<?php

namespace Database\Seeders;

use App\Helpers\CSVFileReader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketFlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        $reader = new CSVFileReader(base_path('/database/csv/ticket_flights.csv'));
        foreach ($reader->chunk(300) as $chunk) {
            DB::table('ticket_flights')->insert(array_map(fn($row) => [
                'ticket_no' => $row[0],
                'flight_id' => $row[1],
                'fare_conditions' => $row[2],
                'amount' => $row[3],
            ], $chunk));
        }
    }
}
