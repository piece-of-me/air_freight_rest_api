<?php

namespace App\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Seats",
 *     description="Сведения о пассажирском месте",
 *     @OA\Xml(
 *         name="Seats"
 *     )
 * )
 */
class Seats
{
    /**
     * @OA\Property(
     *     title="seat_id",
     *     description="Id места",
     *     example="779"
     * )
     *
     * @var int
     */
    public int $seat_id;
    /**
     * @OA\Property(
     *     title="seat_no",
     *     description="Номер места",
     *     example="1A"
     * )
     *
     * @var string
     */
    public string $seat_no;
    /**
     * @OA\Property(
     *     title="fare_conditions",
     *     description="Тариф",
     *     example="Business",
     *     enum={"Business", "Comfort", "Economy"}
     * )
     *
     * @var string
     */
    public string $fare_conditions;
}