<?php

namespace App\Swagger\Controllers;

/**
 * @OA\Get(
 *      path="/api/airports",
 *      summary="Получение всех аэропортов",
 *      tags={"Airports"},
 *
 *      @OA\Parameter(
 *          name="airport_code",
 *          description="Код аэропорта",
 *          in="query",
 *          example="MJZ",
 *          @OA\Schema(type="string"),
 *          required=false,
 *      ),
 *      @OA\Parameter(
 *          name="airport_name",
 *          description="Название аэропорта",
 *          in="query",
 *          example="Мирный",
 *          @OA\Schema(type="string"),
 *          required=false,
 *      ),
 *      @OA\Parameter(
 *          name="city",
 *          description="Город, в котором расположен аэропорт",
 *          in="query",
 *          example="Мирный",
 *          @OA\Schema(type="string"),
 *          required=false,
 *      ),
 *      @OA\Parameter(
 *          name="timezone",
 *          description="Временная зона аэропорта",
 *          in="query",
 *          example="Asia/Yakutsk",
 *          @OA\Schema(type="string"),
 *          required=false,
 *      ),
 *
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(ref="#/components/schemas/AirportResource"),
 *      ),
 * ),
 * @OA\Post(
 *      path="/api/airports",
 *      summary="Добавление аэропорта",
 *      tags={"Airports"},
 *      security={{ "bearerAuth": {} }},
 *
 *      @OA\RequestBody(
 *          @OA\JsonContent(ref="#/components/schemas/StoreAirportRequest")
 *      ),
 *
 *      @OA\Response(
 *          response=201,
 *          description="Успешное добавление",
 *          @OA\MediaType(mediaType="application/json"),
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Неавторизованный запрос",
 *          @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthenticated.")),
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Ошибка валидации входящих данных",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Поле ""code"" должно присутствовать (and 5 more errors)"),
 *              @OA\Property(property="errors", type="array", @OA\Items(
 *                  @OA\Property(property="code", type="string", example="Поле ""code"" должно присутствовать"),
 *                  @OA\Property(property="name", type="string", example="Поле ""name"" должно присутствовать"),
 *                  @OA\Property(property="city", type="string", example="Поле ""city"" должно присутствовать"),
 *                  @OA\Property(property="longitude", type="string", example="Поле ""longitude"" должно присутствовать"),
 *                  @OA\Property(property="latitude", type="string", example="Поле ""latitude"" должно присутствовать"),
 *                  @OA\Property(property="timezone", type="string", example="Поле ""timezone"" должно присутствовать"),
 *              ))
 *          )
 *      )
 * ),
 * @OA\Get(
 *      path="/api/airports/{airport}",
 *      summary="Получение аэропорта",
 *      tags={"Airports"},
 *
 *      @OA\Parameter(
 *          name="airport",
 *          description="Код аэропорта",
 *          required=true,
 *          in="path",
 *          example="MJZ",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(ref="#/components/schemas/AirportResource")
 *              },
 *              example={
 *                  "data": {
 *                      {
 *                          "code": "763",
 *                          "model": "Boeing 767-300",
 *                          "range": 7900,
 *                      }
 *                  }
 *              }
 *          ),
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Not found",
 *      ),
 * ),
 * @OA\Patch(
 *      path="/api/airports/{airport}",
 *      summary="Обновление данных аэропорта",
 *      tags={"Airports"},
 *      security={{ "bearerAuth": {} }},
 *
 *      @OA\Parameter(
 *          name="aircraft",
 *          description="Код аэропорта",
 *          required=true,
 *          in="path",
 *          example="MJZ",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *
 *      @OA\RequestBody(
 *          @OA\JsonContent(ref="#/components/schemas/UpdateAirportRequest")
 *      ),
 *
 *      @OA\Response(
 *          response=200,
 *          description="Успешное обновление данных",
 *          @OA\MediaType(mediaType="application/json"),
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Неавторизованный запрос",
 *          @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthenticated.")),
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Not found",
 *          @OA\MediaType(mediaType="application/json"),
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Ошибка валидации входящих данных",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Поле ""name"" не должно быть длиннее 100 символов (and 4 more errors)"),
 *              @OA\Property(property="errors", type="array", @OA\Items(
 *                  @OA\Property(property="name", type="string", example="Поле ""name"" не должно быть длиннее 100 символов"),
 *                  @OA\Property(property="city", type="string", example="Поле ""city"" не должно быть длиннее 100 символов"),
 *                  @OA\Property(property="longitude", type="string", example="Поле ""longitude"" не должно быть длиннее 20 символов"),
 *                  @OA\Property(property="latitude", type="string", example="Поле ""latitude"" не должно быть длиннее 20 символов"),
 *                  @OA\Property(property="timezone", type="string", example="Поле ""timezone"" не должно быть длиннее 30 символов"),
 *              ))
 *          )
 *      )
 * )
 */
class AirportController
{

}
