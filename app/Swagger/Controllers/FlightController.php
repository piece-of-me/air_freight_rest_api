<?php

namespace App\Swagger\Controllers;

/**
 * @OA\Get(
 *      path="/api/flights",
 *      summary="Получение всех рейсов",
 *      tags={"Flights"},
 *
 *      @OA\RequestBody(
 *          @OA\JsonContent(ref="#/components/schemas/IndexFlightRequest")
 *      ),
 *
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(ref="#/components/schemas/FlightSingleResource")
 *              },
 *              example={
 *                  "data": {
 *                      {
 *                          "flight_no": "PG0405",
 *                          "scheduled_departure": "2016-09-13 05:35:00+00",
 *                          "scheduled_arrival": "2016-09-13 06:30:00+00",
 *                          "status": "Arrived"
 *                      },
 *                      {
 *                          "flight_no": "PG0404",
 *                          "scheduled_departure": "2016-10-03 15:05:00+00",
 *                          "scheduled_arrival": "2016-10-03 16:00:00+00",
 *                          "status": "Arrived"
 *                      },
 *                      {
 *                          "flight_no": "PG0405",
 *                          "scheduled_departure": "2016-10-03 05:35:00+00",
 *                          "scheduled_arrival": "2016-10-03 06:30:00+00",
 *                          "status": "Arrived"
 *                      },
 *                  }
 *              }
 *          ),
 *      ),
 * ),
 * @OA\Get(
 *      path="/api/flights/{flight}",
 *      summary="Получение информации о конкретном рейсе",
 *      tags={"Flights"},
 *
 *      @OA\Parameter(
 *          name="flight",
 *          description="Код рейса",
 *          required=true,
 *          in="path",
 *          example="PG0405",
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
 *                  @OA\Schema(ref="#/components/schemas/FlightResource")
 *              },
 *              example={
 *                  "data": {
 *                      {
 *                          "flight_no": "PG0405",
 *                          "scheduled_departure": "2016-09-13 05:35:00+00",
 *                          "scheduled_arrival": "2016-09-13 06:30:00+00",
 *                          "departure_airport": {
 *                              "code": "DME",
 *                              "name": "Домодедово",
 *                              "city": "Москва",
 *                              "longitude": "37.906111",
 *                              "latitude": "55.408611",
 *                              "timezone": "Europe/Moscow"
 *                          },
 *                          "arrival_airport": {
 *                              "code": "LED",
 *                              "name": "Пулково",
 *                              "city": "Санкт-Петербург",
 *                              "longitude": "30.262503",
 *                              "latitude": "59.800292",
 *                              "timezone": "Europe/Moscow"
 *                          },
 *                          "status": "Arrived",
 *                          "aircraft": {
 *                              "code": "321",
 *                              "model": "Airbus A321-200",
 *                              "range": 5600
 *                          },
 *                          "actual_departure": "2016-09-13 05:44:00+00",
 *                          "actual_arrival": "2016-09-13 06:39:00+00"
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
 * @OA\Post(
 *      path="/api/flights",
 *      summary="Добавление рейса",
 *      tags={"Flights"},
 *
 *      @OA\RequestBody(
 *          @OA\JsonContent(ref="#/components/schemas/StoreFlightRequest")
 *      ),
 *
 *      @OA\Response(
 *          response=201,
 *          description="Успешное добавление",
 *          @OA\JsonContent(
 *              @OA\Property(property="flight_no", type="string", description="Номер рейса", example="VM6918")
 *          ),
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Ошибка валидации входящих данных",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Поле ""scheduled departure"" должно присутствовать (and 2 more errors)"),
 *              @OA\Property(property="errors", type="array", @OA\Items(
 *                  @OA\Property(property="scheduled_departure", type="string", example="Поле ""scheduled departure"" должно присутствовать"),
 *                  @OA\Property(property="status", type="string", example="Поле ""status"" должно быть одним из возможных вариантов"),
 *                  @OA\Property(property="aircraft_code", type="string", example="Поле ""aircraft code"" должно существовать в базе данных"),
 *              ))
 *          )
 *      )
 * ),
 * @OA\Patch (
 *      path="/api/flights",
 *      summary="Обновление информации о рейсе",
 *      tags={"Flights"},
 *
 *      @OA\RequestBody(
 *          @OA\JsonContent(ref="#/components/schemas/UpdateFlightRequest")
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
 *              @OA\Property(property="message", type="string", example="Необходимо передать хотя бы один параметр (and 3 more errors)"),
 *              @OA\Property(property="errors", type="array", @OA\Items(
 *                  @OA\Property(property="status", type="string", example="Необходимо передать хотя бы один параметр"),
 *                  @OA\Property(property="aircraft_code", type="string", example="Необходимо передать хотя бы один параметр"),
 *                  @OA\Property(property="actual_departure", type="string", example="Необходимо передать хотя бы один параметр"),
 *                  @OA\Property(property="actual_arrival", type="string", example="Необходимо передать хотя бы один параметр"),
 *              ))
 *          )
 *      )
 * ),
 * @OA\Get(
 *      path="/api/flights/{flight}/tickets",
 *      summary="Получение билетов рейса",
 *      tags={"Flights"},
 *
 *      @OA\Parameter(
 *          name="flight",
 *          description="Id рейса",
 *          required=true,
 *          in="path",
 *          example="1",
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
 *                  @OA\Schema(ref="#/components/schemas/FlightTicketsResource")
 *              },
 *              example={
 *                  "data": {
 *                      {
 *                          "ticket_no": "0005432816945",
 *                          "passenger_id": "8841 094140",
 *                          "passenger_name": "EVGENIY MATVEEV",
 *                          "contact_data": {
 *                              "phone": "+70499680033"
 *                          },
 *                          "booking": {
 *                              "book_date": "2016-08-29 23:06:00+00",
 *                              "total_amount": "70200.00"
 *                          }
 *                      },
 *                      {
 *                          "ticket_no": "0005432261098",
 *                          "passenger_id": "7453 780162",
 *                          "passenger_name": "SVETLANA VOROBEVA",
 *                          "contact_data": {
 *                              "email": "s.vorobeva.08081974@postgrespro.ru",
 *                              "phone": "+70635611161"
 *                          },
 *                          "booking": {
 *                              "book_date": "2016-08-28 15:24:00+00",
 *                              "total_amount": "46700.00"
 *                          }
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
 */
class FlightController
{
}
