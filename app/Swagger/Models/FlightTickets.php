<?php

namespace App\Swagger\Models;

/**
 * @OA\Schema(
 *     title="FlightTickets",
 *     description="Билеты, проданные для конкретного рейса",
 *     @OA\Xml(
 *         name="FlightTickets"
 *     )
 * )
 */
class FlightTickets
{
    /**
     * @OA\Property(
     *     description="Номер билета",
     *     example="0005432816945"
     * )
     *
     * @var string
     */
    public string $ticket_no;

    /**
     * @OA\Property(
     *     description="Идентификатор пассажира",
     *     example="8841 094140"
     * )
     *
     * @var string
     */
    public string $passenger_id;

    /**
     * @OA\Property(
     *     description="Фамилия и имя пассажира",
     *     example="EVGENIY MATVEEV"
     * )
     *
     * @var string
     */
    public string $passenger_name;

    /**
     * @OA\Property(
     *     description="Фамилия и имя пассажира",
     * )
     *
     * @var FlightTicketsContactData
     */
    public FlightTicketsContactData $contact_data;

    /**
     * @OA\Property(
     *     description="Данные бронирования",
     * )
     *
     * @var Booking
     */
    public Booking $booking;
}