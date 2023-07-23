<?php

namespace App\Swagger\Requests\Aircraft;



/**
 * @OA\Schema(
 *      title="UpdateAircraftRequest",
 *      description="Данные, необходимые для обновления самолета",
 *      type="object"
 * )
 */
class UpdateAircraftRequest
{
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
