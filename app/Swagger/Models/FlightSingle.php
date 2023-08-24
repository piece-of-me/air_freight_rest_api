<?php

namespace App\Swagger\Models;

/**
 * @OA\Schema(
 *     title="FlightSingle",
 *     description="Рейс",
 *     @OA\Xml(
 *         name="FlightSingle"
 *     )
 * )
 */
class FlightSingle
{
    /**
     * @OA\Property(
     *     description="Код рейса",
     *     example="PG0405"
     * )
     *
     * @var string
     */
    public string $flight_no;

    /**
     * @OA\Property(
     *     description="Запланированная дата отправления",
     *     example="2016-09-13 05:35:00+00"
     * )
     *
     * @var string
     */
    public string $scheduled_departure;

    /**
     * @OA\Property(
     *     description="Запланированная дата прибытия",
     *     example="2016-09-13 06:30:00+00"
     * )
     *
     * @var string
     */
    public string $scheduled_arrival;

    /**
     * @OA\Property(
     *     description="Статус рейса",
     *     example="Arrived",
     *     enum={"Arrived", "Scheduled", "On Time"}
     * )
     *
     * @var string
     */
    public string $status;
}
