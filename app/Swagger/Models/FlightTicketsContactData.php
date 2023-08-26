<?php

namespace App\Swagger\Models;


/**
 * @OA\Schema(
 *     title="FlightTicketsContactData",
 *     description="Контактные данные пасссажира",
 *     @OA\Xml(
 *         name="FlightTicketsContactData"
 *     )
 * )
 */
class FlightTicketsContactData
{
    /**
     * @OA\Property(
     *     description="Номер телефона",
     *     example="+70635611161"
     * )
     *
     * @var string
     */
    public string $phone;

    /**
     * @OA\Property(
     *     description="Адрес электронной почты",
     *     example="s.vorobeva.08081974@postgrespro.ru"
     * )
     *
     * @var string
     */
    public string $email;
}