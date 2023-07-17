<?php

namespace Database\Seeders;

use App\Helpers\CSVFileReader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AircraftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        $reader = new CSVFileReader(base_path('/database/csv/aircrafts.csv'));
        foreach ($reader->rows() as $row) {
            DB::table('aircrafts')->insert([
                'aircraft_code' => $row[0],
                'model' => $row[1],
                'range' => $row[2],
            ]);
        };
    }
}
