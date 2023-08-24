<?php

namespace App\Swagger\Requests\Flight;

/**
 * @OA\Schema(
 *      title="UpdateFlightRequest",
 *      description="Данные, необходимые для обновления информации рейса",
 *      type="object"
 * )
 */
class UpdateFlightRequest
{
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
