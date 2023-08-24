<?php

namespace App\Swagger\Resources;

use App\Swagger\Models\FlightSingle;

/**
 * @OA\Schema(
 *     title="FlightSingleResource",
 *     description="Поля рейса",
 *     @OA\Xml(
 *         name="FlightSingleResource"
 *     )
 * )
 */
class FlightSingleResource
{
    /**
     * @OA\Property(
     *     title="data",
     *     description="Data wrapper"
     * )
     *
     * @var FlightSingle[]
     */
    public array $data;
}
