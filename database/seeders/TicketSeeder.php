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
                'contact_data' => $this->_fixJson($row),
            ], $chunk));
        }
    }

    private function _fixJson(array $row): ?string
    {
        if (sizeof($row) < 5) return null;
        $size = sizeof($row);
        $result = [];
        for ($i = 4; $i < $size; $i++) {
            preg_match_all('/(?<=[\'|"])([\w\.@\d+]+)(?=[\'|"])/i', $row[$i], $matches);
            if (isset($matches[0][0], $matches[0][1])) {
                $result[$matches[0][0]] = $matches[0][1];
            }
        }
        return sizeof($result) > 0 ? json_encode($result) : null;
    }
}
