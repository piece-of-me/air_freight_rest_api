<?php

namespace App\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Airport",
 *     description="Модель ""Аэропорт""",
 *     @OA\Xml(
 *         name="Airport"
 *     )
 * )
 */
class Airport
{
    /**
     * @OA\Property(
     *     title="code",
     *     description="Код аэропорта",
     *     example="MJZ"
     * )
     *
     * @var string
     */
    public string $code;

    /**
     * @OA\Property(
     *     title="name",
     *     description="Название аэропорта",
     *     example="Мирный"
     * )
     *
     * @var string
     */
    public string $name;

    /**
     * @OA\Property(
     *     title="city",
     *     description="Город",
     *     example="Мирный"
     * )
     *
     * @var string
     */
    public string $city;

    /**
     * @OA\Property(
     *     title="longitude",
     *     description="Координаты аэропорта: долгота",
     *     example=114.038928
     * )
     *
     * @var float
     */
    public float $longitude;

    /**
     * @OA\Property(
     *     title="latitude",
     *     description="Координаты аэропорта: широта",
     *     example=62.534689
     * )
     *
     * @var float
     */
    public float $latitude;

    /**
     * @OA\Property(
     *     title="timezone",
     *     description="Временная зона аэропорта",
     *     example="Asia/Yakutsk"
     * )
     *
     * @var string
     */
    public string $timezone;
}