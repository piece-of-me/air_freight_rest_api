<?php

namespace App\Services;

use App\Models\Flight;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AircraftService
{
    public function amount(string $aircraftCode, string $type): JsonResponse
    {
        try {
            $result = match ($type) {
                'total' => $this->totalAmount($aircraftCode),
                'month' => $this->monthAmount($aircraftCode),
                default => null,
            };
            return response()->json(['result' => $result]);
        } catch (\Exception $exception) {
            return response()->json(status: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function totalAmount(string $aircraftCode): float
    {
        $totalAmount = DB::table('aircrafts')
            ->select(['aircrafts.aircraft_code', 'bookings.total_amount'])
            ->where('aircrafts.aircraft_code', '=', $aircraftCode)
            ->rightJoin('flights', 'flights.aircraft_code', '=', 'aircrafts.aircraft_code')
            ->join('ticket_flights', 'ticket_flights.flight_id', '=', 'flights.flight_id')
            ->join('tickets', 'tickets.ticket_no', '=', 'ticket_flights.ticket_no')
            ->join('bookings', 'bookings.book_ref', '=', 'tickets.book_ref')
            ->groupBy('aircrafts.aircraft_code')
            ->sum('bookings.total_amount');
        return (float)$totalAmount;
    }

    private function monthAmount(string $aircraftCode): array
    {
        return DB::table('aircrafts')
            ->selectRaw('TO_CHAR("flights"."scheduled_departure", \'YYYY-MM\') AS month, SUM(bookings.total_amount) AS total')
            ->where('aircrafts.aircraft_code', '=', $aircraftCode)
            ->rightJoin('flights', 'flights.aircraft_code', '=', 'aircrafts.aircraft_code')
            ->join('ticket_flights', 'ticket_flights.flight_id', '=', 'flights.flight_id')
            ->join('tickets', 'tickets.ticket_no', '=', 'ticket_flights.ticket_no')
            ->join('bookings', 'bookings.book_ref', '=', 'tickets.book_ref')
            ->groupBy('month')->get()->all();
    }

    public function time(string $aircraftCode, string $type): JsonResponse
    {
        try {
        $result = match ($type) {
            'total' => $this->totalTime($aircraftCode),
            'month' => $this->timePerMonth($aircraftCode),
            default => null,
        };

        return response()->json(['result' => $result]);
        } catch (\Exception $exception) {
            return response()->json(status: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /** @throws \Exception */
    private function totalTime(string $aircraftCode): int
    {
        $totalTime = DB::table('aircrafts')
            ->selectRaw('aircrafts.aircraft_code, SUM(flights.actual_arrival - flights.actual_departure) AS total')
            ->where('aircrafts.aircraft_code', '=', $aircraftCode)
            ->where('flights.status', '=', Flight::STATUS_ARRIVED)
            ->rightJoin('flights', 'flights.aircraft_code', 'aircrafts.aircraft_code')
            ->groupBy('aircrafts.aircraft_code')
            ->get();
        $total = $totalTime->first()->total ?? '';
        return $this->parseTimeToSeconds($total);
    }

    private function timePerMonth(string $aircraftCode): array
    {
        $result =  DB::table('aircrafts')
            ->selectRaw('TO_CHAR("flights"."scheduled_departure", \'YYYY-MM\') AS month, SUM("flights"."actual_arrival" - "flights"."actual_departure") AS total')
            ->where('aircrafts.aircraft_code', '=', $aircraftCode)
            ->where('flights.status', '=', Flight::STATUS_ARRIVED)
            ->rightJoin('flights', 'flights.aircraft_code', 'aircrafts.aircraft_code')
            ->groupBy('month')
            ->get();

        return $result->map(function($item) {
            return [
                'month' => $item->month,
                'total' => $this->parseTimeToSeconds($item->total),
            ];
        })->all();
    }

    /**
     * Парсинг времени из строки вида "ЧЧ:ММ:СС" в секунды
     * @throws \Exception
     */
    private function parseTimeToSeconds(string $time): float
    {
        $result = explode(':', $time);
        if (sizeof($result) <= 0) {
            throw new \Exception();
        }
        return (+$result[0] * 60 * 60) + (+$result[1] * 60) + +$result[2];
    }
}