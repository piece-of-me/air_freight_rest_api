<?php

namespace App\Swagger\Resources;

use App\Swagger\Models\Flight;

/**
 * @OA\Schema(
 *     title="FlightResource",
 *     description="Поля рейса",
 *     @OA\Xml(
 *         name="FlightResource"
 *     )
 * )
 */
class FlightResource
{
    /**
     * @OA\Property(
     *     title="data",
     *     description="Data wrapper"
     * )
     *
     * @var Flight[]
     */
    public array $data;
}
