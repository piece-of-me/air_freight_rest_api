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
 *                          "seats": {
 *                              {
 *                                  "seat_id": 779,
 *                                  "seat_no": "1A",
 *                                  "fare_conditions": "Business"
 *                              },
 *                              {
 *                                   "seat_id": 780,
 *                                   "seat_no": "1C",
 *                                   "fare_conditions": "Business"
 *                               },
 *                              {
 *                                    "seat_id": 781,
 *                                    "seat_no": "1D",
 *                                    "fare_conditions": "Business"
 *                                },
 *                          }
 *                      },
 *                      {
 *                          "code": "763",
 *                          "model": "Boeing 767-300",
 *                          "range": 7900,
 *                               "seats": {
 *                               {
 *                                   "seat_id": 557,
 *                                   "seat_no": "1A",
 *                                   "fare_conditions": "Business"
 *                               },
 *                               {
 *                                    "seat_id": 558,
 *                                    "seat_no": "1B",
 *                                    "fare_conditions": "Business"
 *                                },
 *                               {
 *                                     "seat_id": 559,
 *                                     "seat_no": "1C",
 *                                     "fare_conditions": "Business"
 *                                 },
 *                           }
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
 *      security={{ "bearerAuth": {} }},
 *
 *      @OA\RequestBody(
 *          @OA\JsonContent(ref="#/components/schemas/StoreAircraftRequest")
 *      ),
 *
 *      @OA\Response(
 *          response=201,
 *          description="Успешное добавление",
 *          @OA\MediaType(mediaType="application/json"),
 *      ),
 *      @OA\Response(
 *           response=401,
 *           description="Неавторизованный запрос",
 *           @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthenticated.")),
 *       ),
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
 *              type="string"
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
 *      security={{ "bearerAuth": {} }},
 *
 *      @OA\Parameter(
 *          name="aircraft",
 *          description="Код самолета",
 *          required=true,
 *          in="path",
 *          example="785",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *
 *      @OA\RequestBody(
 *          @OA\JsonContent(ref="#/components/schemas/UpdateAircraftRequest")
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
 *              @OA\Property(property="message", type="string", example="Поле ""model"" не должно быть длиннее 50 символов (and 1 more error)"),
 *              @OA\Property(property="errors", type="array", @OA\Items(
 *                  @OA\Property(property="model", type="string", example="Поле ""model"" не должно быть длиннее 50 символов"),
 *                  @OA\Property(property="range", type="string", example="Поле ""range"" должно быть числом"),
 *              ))
 *          )
 *      )
 * ),
 * @OA\Get(
 *       path="/api/aircrafts/{aircraft}/amount/total",
 *       summary="Получение суммарной прибыли самолета",
 *       tags={"Aircrafts"},
 *
 *       @OA\Parameter(
 *           name="aircraft",
 *           description="Код самолета",
 *           required=true,
 *           in="path",
 *           example="773",
 *           @OA\Schema(
 *               type="string"
 *           )
 *       ),
 *
 *       @OA\Response(
 *           response=200,
 *           description="Ok",
 *           @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="result", type="float", description="Суммарная прибыль", example="11932336800.00")
 *                  )
 *              }
 *           ),
 *       ),
 *       @OA\Response(
 *           response=404,
 *           description="Not found",
 *       ),
 *  ),
 * @OA\Get(
 *        path="/api/aircrafts/{aircraft}/amount/month",
 *        summary="Получение прибыли самолета по месяцам",
 *        tags={"Aircrafts"},
 *
 *        @OA\Parameter(
 *            name="aircraft",
 *            description="Код самолета",
 *            required=true,
 *            in="path",
 *            example="773",
 *            @OA\Schema(
 *                type="string"
 *            )
 *        ),
 *
 *        @OA\Response(
 *            response=200,
 *            description="Ok",
 *            @OA\JsonContent(
 *                  @OA\Property(property="result", type="array", @OA\Items(
 *                      @OA\Property(property="month", type="string", description="год-месяц"),
 *                      @OA\Property(property="total", type="string", description="Прибыль за месяц")
 *                  )),
 *                  example={
 *                      "result": {
 *                          {
 *                              "month": "2016-09",
 *                              "total": "3285567400.00",
 *                          },
 *                          {
 *                              "month": "2016-10",
 *                              "total": "7651578300.00",
 *                          },
 *                          {
 *                               "month": "2016-11",
 *                               "total": "995191100.00",
 *                          }
 *                      }
 *                  }
 *            )
 *        ),
 *        @OA\Response(
 *            response=404,
 *            description="Not found",
 *        ),
 *  ),
 * @OA\Get(
 *        path="/api/aircrafts/{aircraft}/time/total",
 *        summary="Получение суммарного времени нахождения самолета в воздухе",
 *        tags={"Aircrafts"},
 *
 *        @OA\Parameter(
 *            name="aircraft",
 *            description="Код самолета",
 *            required=true,
 *            in="path",
 *            example="773",
 *            @OA\Schema(
 *                type="string"
 *            )
 *        ),
 *
 *        @OA\Response(
 *            response=200,
 *            description="Ok",
 *            @OA\JsonContent(
 *               allOf={
 *                   @OA\Schema(
 *                       @OA\Property(property="result", type="float", description="Суммарное время, секунды", example="2605440")
 *                   )
 *               }
 *            ),
 *        ),
 *        @OA\Response(
 *            response=404,
 *            description="Not found",
 *        ),
 *   ),
 * @OA\Get(
 *         path="/api/aircrafts/{aircraft}/time/month",
 *         summary="Получение времени нахождения самолета в воздухе по месяцам",
 *         tags={"Aircrafts"},
 *
 *         @OA\Parameter(
 *             name="aircraft",
 *             description="Код самолета",
 *             required=true,
 *             in="path",
 *             example="773",
 *             @OA\Schema(
 *                 type="string"
 *             )
 *         ),
 *
 *         @OA\Response(
 *             response=200,
 *             description="Ok",
 *             @OA\JsonContent(
 *                   @OA\Property(property="result", type="array", @OA\Items(
 *                       @OA\Property(property="month", type="string", description="год-месяц"),
 *                       @OA\Property(property="total", type="string", description="Время в воздухе, секунды")
 *                   )),
 *                   example={
 *                       "result": {
 *                           {
 *                               "month": "2016-09",
 *                               "total": "1522560",
 *                           },
 *                           {
 *                               "month": "2016-10",
 *                               "total": "1082880",
 *                           }
 *                       }
 *                   }
 *             )
 *         ),
 *         @OA\Response(
 *             response=404,
 *             description="Not found",
 *         ),
 *  ),
 */
class AircraftController
{
}
