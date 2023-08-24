<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->routeIs('flights.index')) {
            return [
                'flight_no' => $this->flight_no,
                'scheduled_departure' => $this->scheduled_departure,
                'scheduled_arrival' => $this->scheduled_arrival,
                'status' => $this->status,
            ];
        } else {
            return [
                'flight_no' => $this->flight_no,
                'scheduled_departure' => $this->scheduled_departure,
                'scheduled_arrival' => $this->scheduled_arrival,
                'departure_airport' => new AirportResource($this->departureAirport),
                'arrival_airport' => new AirportResource($this->arrivalAirport),
                'status' => $this->status,
                'aircraft' => new AircraftResource($this->aircraft),
                'actual_departure' => $this->actual_departure,
                'actual_arrival' => $this->actual_arrival,
            ];
        }
    }
}
