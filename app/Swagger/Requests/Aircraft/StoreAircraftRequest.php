<?php

namespace App\Swagger\Requests\Aircraft;

/**
 * @OA\Schema(
 *      title="StoreAircraftRequest",
 *      description="Данные, необходимые для добавления самолета",
 *      type="object",
 *      required={"code", "model", "range"}
 * )
 */
class StoreAircraftRequest
{
    /**
     * @OA\Property(
     *      title="code",
     *      description="Код самолета, IATA",
     *      example="785"
     * )
     * @var string
     */
    public string $code;

    /**
     * @OA\Property(
     *      title="model",
     *      description="Модель самолета",
     *      example="Sukhoi SuperJet-100"
     * )
     * @var string
     */
    public string $model;

    /**
     * @OA\Property(
     *      title="range",
     *      description="Максимальная дальность полета, км",
     *      example="3000"
     * )
     * @var int
     */
    public int $range;
}
