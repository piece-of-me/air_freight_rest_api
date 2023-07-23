<?php

namespace App\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Aircraft",
 *     description="Модель ""Самолет""",
 *     @OA\Xml(
 *         name="Aircraft"
 *     )
 * )
 */
class Aircraft
{
    /**
     * @OA\Property(
     *     title="aircraft_code",
     *     description="Код самолета, IATA",
     *     example="773"
     * )
     *
     * @var string
     */
    public string $aircraft_code;

    /**
     * @OA\Property(
     *     title="model",
     *     description="Модель самолета",
     *     example="Sukhoi SuperJet-100"
     * )
     *
     * @var string
     */
    public string $model;

    /**
     * @OA\Property(
     *     title="range",
     *     description="Максимальная дальность полета, км",
     *     example=3000
     * )
     *
     * @var integer
     */
    public int $range;
}
