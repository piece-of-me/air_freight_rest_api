<?php

namespace Database\Seeders;

use App\Helpers\CSVFileReader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        $reader = new CSVFileReader(base_path('/database/csv/tickets.csv'));
        foreach ($reader->chunk(300) as $chunk) {
            DB::table('tickets')->insert(array_map(fn($row) => [
                'ticket_no' => $row[0],
                'book_ref' => $row[1],
                'passenger_id' => $row[2],
                'passenger_name' => $row[3],
                'contact_data' => json_decode($row[4]),
            ], $chunk));
        }
    }
}
