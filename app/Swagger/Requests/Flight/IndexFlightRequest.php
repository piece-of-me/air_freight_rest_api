<?php

namespace App\Swagger\Requests\Flight;

/**
 * @OA\Schema(
 *      title="IndexFlightRequest",
 *      description="Данные для фильтрации",
 *      type="object"
 * )
 */
class IndexFlightRequest
{
    /**
     * @OA\Property(
     *     description="Номер рейса",
     *     example="PG0405"
     * )
     *
     * @var string
     */
    public string $flight_no;

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

    /**
     * @OA\Property(
     *     description="Фактическое время отправления",
     *     example="2016-09-13 05:36:00"
     * )
     *
     * @var \DateTime
     */
    public \DateTime $actual_departure;

    /**
     * @OA\Property(
     *     description="Фактическое время прибытия",
     *     example="2016-09-14 06:38:00"
     * )
     *
     * @var \DateTime
     */
    public \DateTime $actual_arrival;
}