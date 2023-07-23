<?php

namespace App\Http\Controllers;

use App\Http\Requests\Aircraft\StoreRequest;
use App\Http\Requests\Aircraft\UpdateRequest;
use App\Http\Resources\AircraftResource;
use App\Models\Aircraft;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class AircraftController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AircraftResource::collection(Aircraft::all());
    }

    function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        Aircraft::create([
            'aircraft_code' => $data['code'],
            'model' => $data['model'],
            'range' => $data['range'],
        ]);
        return response()->json(status: Response::HTTP_CREATED);
    }

    public function show(Aircraft $aircraft): AircraftResource
    {
        return new AircraftResource($aircraft);
    }

    public function update(Aircraft $aircraft, UpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $aircraft->update($data);
        return response()->json(status: Response::HTTP_OK);
    }
}
