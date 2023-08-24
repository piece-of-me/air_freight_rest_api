<?php

namespace App\Http\Controllers;

use App\Helpers\FlightNoGenerator;
use App\Http\Requests\Flight\UpdateRequest;
use App\Http\Requests\Flight\StoreRequest;
use App\Http\Resources\FlightResource;
use App\Models\Flight;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class FlightController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        return FlightResource::collection(Flight::all());
    }

    public function show(string $flightNO): AnonymousResourceCollection
    {
        $flights = Flight::where('flight_no', $flightNO)->get();
        return FlightResource::collection($flights);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $flight = Flight::create([
            'flight_no' => $this->_generateFlightNo(),
            'scheduled_departure' => $data['scheduled_departure'],
            'scheduled_arrival' => $data['scheduled_arrival'],
            'departure_airport' => $data['departure_airport'],
            'arrival_airport' => $data['arrival_airport'],
            'status' => $data['status'],
            'aircraft_code' => $data['aircraft_code'],
        ]);
        return response()->json([
            'flight_no' => $flight->flight_no
        ], Response::HTTP_CREATED);
    }

    public function update(Flight $flight, UpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $flight->update($data);
        return response()->json(status: Response::HTTP_OK);
    }

    private function _generateFlightNo(): string
    {
        while (true) {
            $flightNo = FlightNoGenerator::generate();
            if (Flight::where('flight_no', $flightNo)->get()->count() <= 0) {
                return $flightNo;
            }
        }
    }
}
