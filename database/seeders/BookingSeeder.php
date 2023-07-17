<?php

namespace Database\Seeders;

use App\Helpers\CSVFileReader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        $reader = new CSVFileReader(base_path('/database/csv/bookings.csv'));
        foreach ($reader->chunk(100) as $chunk) {
            DB::table('bookings')->insert(array_map(fn($row) => [
                'book_ref' => $row[0],
                'book_date' => $row[1],
                'total_amount' => $row[2],
            ], $chunk));
        }
    }
}
