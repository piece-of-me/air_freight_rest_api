<?php

namespace App\Swagger\Controllers;

/**
 * @OA\Get(
 *      path="/api/aircrafts",
 *      summary="Получение всех самолетов",
 *      tags={"Aircrafts"},
 *
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(ref="#/components/schemas/AircraftResource")
 *              },
 *              example={
 *                  "data": {
 *                      {
 *                          "code": "773",
 *                          "model": "Boeing 777-300",
 *                          "range": 11100,
 *                      },
 *                      {
 *                          "code": "763",
 *                          "model": "Boeing 767-300",
 *                          "range": 7900,
 *                      }
 *                  }
 *              }
 *          ),
 *      ),
 * ),
 * @OA\Post(
 *      path="/api/aircrafts",
 *      summary="Добавление самолета",
 *      tags={"Aircrafts"},
 *
 *      @OA\RequestBody(
 *          @OA\JsonContent(ref="#/components/schemas/StoreAircraftRequest")
 *      ),
 *
 *      @OA\Response(
 *          response=201,
 *          description="Успешное добавление"
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Ошибка валидации входящих данных",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Поле ""code"" должно присутствовать (and 2 more errors)"),
 *              @OA\Property(property="errors", type="array", @OA\Items(
 *                  @OA\Property(property="code", type="string", example="Поле ""code"" должно присутствовать"),
 *                  @OA\Property(property="model", type="string", example="Поле ""model"" должно присутствовать"),
 *                  @OA\Property(property="range", type="string", example="Поле ""range"" должно присутствовать"),
 *              ))
 *          )
 *      )
 * ),
 * @OA\Get(
 *      path="/api/aircrafts/{aircraft}",
 *      summary="Получение самолета",
 *      tags={"Aircrafts"},
 *
 *      @OA\Parameter(
 *          name="aircraft",
 *          description="Код самолета",
 *          required=true,
 *          in="path",
 *          example="773",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(ref="#/components/schemas/AircraftResource")
 *              }
 *          ),
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Not found",
 *      ),
 * ),
 * @OA\Patch(
 *      path="/api/aircrafts/{aircraft}",
 *      summary="Обновление данных самолета",
 *      tags={"Aircrafts"},
 *
 *      @OA\Parameter(
 *          name="aircraft",
 *          description="Код самолета",
 *          required=true,
 *          in="path",
 *          example="785",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *
 *      @OA\RequestBody(
 *          @OA\JsonContent(ref="#/components/schemas/UpdateAircraftRequest")
 *      ),
 *
 *      @OA\Response(
 *          response=200,
 *          description="Успешное обновление данных"
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Not found",
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Ошибка валидации входящих данных",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Поле ""model"" не должно быть длиннее 50 символов (and 1 more error)"),
 *              @OA\Property(property="errors", type="array", @OA\Items(
 *                  @OA\Property(property="model", type="string", example="Поле ""model"" не должно быть длиннее 50 символов"),
 *                  @OA\Property(property="range", type="string", example="Поле ""range"" должно быть числом"),
 *              ))
 *          )
 *      )
 * )
 */
class AircraftController
{
}
