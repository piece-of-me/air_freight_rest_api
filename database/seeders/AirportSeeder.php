<?php

namespace Database\Seeders;

use App\Helpers\CSVFileReader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        $reader = new CSVFileReader(base_path('/database/csv/airports.csv'));
        foreach ($reader->rows() as $row) {
            DB::table('airports')->insert([
                'airport_code' => $row[0],
                'airport_name' => $row[1],
                'city' => $row[2],
                'longitude' => $row[3],
                'latitude' => $row[4],
                'timezone' => $row[5],
            ]);
        };
    }
}
