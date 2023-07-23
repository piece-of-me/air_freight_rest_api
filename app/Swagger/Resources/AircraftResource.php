<?php

namespace App\Swagger\Resources;

/**
 * @OA\Schema(
 *     title="AircraftResource",
 *     description="Поля самолета",
 *     @OA\Xml(
 *         name="AircraftResource"
 *     )
 * )
 */
class AircraftResource
{
    /**
     * @OA\Property(
     *     title="data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Swagger\Models\Aircraft[]|\App\Swagger\Models\Aircraft
     */
    private array|object $data;
}
