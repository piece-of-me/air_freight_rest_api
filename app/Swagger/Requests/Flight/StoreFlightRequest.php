<?php

namespace App\Swagger\Requests\Flight;

/**
 * @OA\Schema(
 *      title="StoreFlightRequest",
 *      description="Данные, необходимые для добавления рейса",
 *      type="object",
 *      required={"scheduled_departure", "scheduled_arrival", "departure_airport", "arrival_airport", "status", "aircraft_code"}
 * )
 */
class StoreFlightRequest
{
    /**
     * @OA\Property(
     *     description="Дата отправления",
     *     example="2016-09-13 05:35:00"
     * )
     *
     * @var \DateTime
     */
    public \DateTime $scheduled_departure;

    /**
     * @OA\Property(
     *     description="Дата прибытия",
     *     example="2016-09-14 06:30:00"
     * )
     *
     * @var \DateTime
     */
    public \DateTime $scheduled_arrival;

    /**
     * @OA\Property(
     *     description="Код аэропорта отправления",
     *     example="DME"
     * )
     *
     * @var string
     */
    public string $departure_airport;

    /**
     * @OA\Property(
     *     description="Код аэропорта прибытия",
     *     example="HMA"
     * )
     *
     * @var string
     */
    public string $arrival_airport;

    /**
     * @OA\Property(
     *     description="Статус рейса",
     *     example="On Time"
     * )
     *
     * @var string
     */
    public string $status;

    /**
     * @OA\Property(
     *     description="Код самолета, IATA",
     *     example=321
     * )
     *
     * @var int
     */
    public int $aircraft_code;
}
