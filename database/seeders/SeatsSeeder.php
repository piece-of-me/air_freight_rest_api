<?php

namespace Database\Seeders;

use App\Helpers\CSVFileReader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        $reader = new CSVFileReader(base_path('/database/csv/seats.csv'));
        foreach ($reader->rows() as $row) {
            DB::table('seats')->insert([
                'aircraft_code' => $row[0],
                'seat_no' => $row[1],
                'fare_conditions' => $row[2],
            ]);
        };
    }
}
