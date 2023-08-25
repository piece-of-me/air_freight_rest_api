<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class FlightFilter extends AbstractFilter
{
    public const FLIGHT_NO = 'flight_no';
    public const SCHEDULED_DEPARTURE = 'scheduled_departure';
    public const SCHEDULED_ARRIVAL = 'scheduled_arrival';
    public const DEPARTURE_AIRPORT = 'departure_airport';
    public const ARRIVAL_AIRPORT = 'arrival_airport';
    public const STATUS = 'status';
    public const AIRCRAFT_CODE = 'aircraft_code';
    public const ACTUAL_DEPARTURE = 'actual_departure';
    public const ACTUAL_ARRIVAL = 'actual_arrival';

    protected function getCallbacks(): array
    {
        return [
            self::FLIGHT_NO => [$this, 'flightNo'],
            self::SCHEDULED_DEPARTURE => [$this, 'scheduledDeparture'],
            self::SCHEDULED_ARRIVAL => [$this, 'scheduledArrival'],
            self::DEPARTURE_AIRPORT => [$this, 'departureAirport'],
            self::ARRIVAL_AIRPORT => [$this, 'arrivalAirport'],
            self::STATUS => [$this, 'status'],
            self::AIRCRAFT_CODE => [$this, 'aircraftCode'],
            self::ACTUAL_DEPARTURE => [$this, 'actualDeparture'],
            self::ACTUAL_ARRIVAL => [$this, 'actualArrival'],
        ];
    }

    public function flightNo(Builder $builder, $value): void
    {
        $builder->where('flight_no', '=', $value);
    }

    public function scheduledDeparture(Builder $builder, $value): void
    {
        $builder->where('scheduled_departure', 'like', '%' . $value . '%');
    }

    public function scheduledArrival(Builder $builder, $value): void
    {
        $builder->where('scheduled_arrival', 'like', '%' . $value . '%');
    }

    public function departureAirport(Builder $builder, $value): void
    {
        $builder->where('departure_airport', '=', $value);
    }

    public function arrivalAirport(Builder $builder, $value): void
    {
        $builder->where('arrival_airport', '=', $value);
    }

    public function status(Builder $builder, $value): void
    {
        $builder->where('status', '=', $value);
    }

    public function aircraftCode(Builder $builder, $value): void
    {
        $builder->where('aircraft_code', '=', $value);
    }

    public function actualDeparture(Builder $builder, $value): void
    {
        $builder->where('actual_departure', 'like', '%' . $value . '%');
    }

    public function actualArrival(Builder $builder, $value): void
    {
        $builder->where('actual_arrival', 'like', '%' . $value . '%');
    }
}
