<?php

namespace App\Swagger\Resources;

/**
 * @OA\Schema(
 *     title="AirportResource",
 *     description="Поля авэропорта",
 *     @OA\Xml(
 *         name="AirportResource"
 *     )
 * )
 */
class AirportResource
{
    /**
     * @OA\Property(
     *     title="data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Swagger\Models\Airport[]
     */
    private array $data;
}