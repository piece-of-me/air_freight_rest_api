<?php

namespace App\Http\Controllers;

use App\Http\Filters\AirportFilter;
use App\Http\Requests\Airport\IndexRequest;
use App\Http\Requests\Airport\StoreRequest;
use App\Http\Requests\Airport\UpdateRequest;
use App\Http\Resources\AirportResource;
use App\Models\Airport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class AirportController extends Controller
{
    public function index(IndexRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();
        $filter = app()->make(AirportFilter::class, ['queryParams' => array_filter($data)]);
        return AirportResource::collection(Airport::filter($filter)->get());
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
        $airport->update([
            'airport_name' => $data['name'],
            'city' => $data['city'],
            'longitude' => $data['longitude'],
            'latitude' => $data['latitude'],
            'timezone' => $data['timezone'],
        ]);
        return response()->json(status: Response::HTTP_OK);
    }
}
