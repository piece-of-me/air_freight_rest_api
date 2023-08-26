<?php

namespace App\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Booking",
 *     description="Бронирование билета",
 *     @OA\Xml(
 *         name="Booking"
 *     )
 * )
 */
class Booking
{
    /**
     * @OA\Property(
     *     description="Дата бронирования",
     *     example="2016-08-24 02:52:00+00"
     * )
     *
     * @var string
     */
    public string $book_date;

    /**
     * @OA\Property(
     *     description="Полная сумма бронирования",
     *     example="46700.00"
     * )
     *
     * @var string
     */
    public string $total_amount;
}