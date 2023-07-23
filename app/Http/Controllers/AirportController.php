<?php

namespace App\Http\Controllers;

use App\Http\Requests\Airport\StoreRequest;
use App\Http\Requests\Airport\UpdateRequest;
use App\Http\Resources\AirportResource;
use App\Models\Airport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class AirportController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AirportResource::collection(Airport::all());
    }

    function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        Airport::create([
            'airport_code' => $data['code'],
            'airport_name' => $data['name'],
            'city' => $data['city'],
            'longitude' => $data['longitude'],
            'latitude' => $data['latitude'],
            'timezone' => $data['timezone'],
        ]);
        return response()->json(status: Response::HTTP_CREATED);
    }

    public function show(Airport $airport): AirportResource
    {
        return new AirportResource($airport);
    }

    public function update(Airport $airport, UpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $airport->update($data);
        return response()->json(status: Response::HTTP_OK);
    }
}
