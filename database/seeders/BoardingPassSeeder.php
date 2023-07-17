<?php

namespace Database\Seeders;

use App\Helpers\CSVFileReader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardingPassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        $reader = new CSVFileReader(base_path('/database/csv/boarding_passes.csv'));
        foreach ($reader->chunk(150) as $chunk) {
            DB::table('boarding_passes')->insert(array_map(fn($row) => [
                'ticket_no' => $row[0],
                'flight_id' => $row[1],
                'boarding_no' => $row[2],
                'seat_no' => $row[3],
            ], $chunk));
        }
    }
}