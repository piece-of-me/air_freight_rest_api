<?php

namespace App\Swagger\Requests\Airport;


/**
 * @OA\Schema(
 *      title="IndexAirportRequest",
 *      description="Данные для фильтрации списка аэропортов",
 *      type="object"
 * )
 */
class IndexAirportRequest
{
    /**
     * @OA\Property(
     *     description="Код аэропорта",
     *     example="MJZ"
     * )
     *
     * @var string
     */
    public string $airport_code;

    /**
     * @OA\Property(
     *     description="Название аэропорта",
     *     example="Мирный"
     * )
     *
     * @var string
     */
    public string $airport_name;

    /**
     * @OA\Property(
     *     description="Город",
     *     example="Мирный"
     * )
     *
     * @var string
     */
    public string $city;

    /**
     * @OA\Property(
     *     description="Временная зона аэропорта",
     *     example="Asia/Yakutsk"
     * )
     *
     * @var string
     */
    public string $timezone;
}