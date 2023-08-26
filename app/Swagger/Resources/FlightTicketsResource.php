<?php

namespace App\Swagger\Resources;

use App\Swagger\Models\FlightTickets;

/**
 * @OA\Schema(
 *     title="FlightTicketsResource",
 *     description="Билеты, проданные для конкретного рейса",
 *     @OA\Xml(
 *         name="FlightTicketsResource"
 *     )
 * )
 */
class FlightTicketsResource
{
    /**
     * @OA\Property(
     *     title="data",
     *     description="Data wrapper"
     * )
     *
     * @var FlightTickets[]
     */
    public array $data;
}