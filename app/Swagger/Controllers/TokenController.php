<?php

namespace App\Swagger\Controllers;

/**
 * @OA\Post(
 *      path="/api/tokens/create",
 *      summary="Получение токена",
 *      tags={"Token"},
 *
 *      @OA\RequestBody(
 *          @OA\JsonContent(ref="#/components/schemas/CreateTokenRequest")
 *      ),
 *
 *      @OA\Response(
 *          response=200,
 *          description="Успешная аутентификация",
 *          @OA\JsonContent(
 *               @OA\Property(property="token", type="string", example="3|a3hSrH6HOitvbmNqRrv18DXuu99sUIl7ACoQ4BVi", description="Bearer Token")
 *           )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Нуеспешная аутентификация",
 *          @OA\MediaType(mediaType="application/json"),
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Ошибка валидации входящих данных",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Поле ""email"" должно существовать"),
 *              @OA\Property(property="errors", type="array", @OA\Items(
 *                  example={"email": {"Поле ""email"" должно существовать"}}
 *              ))
 *           )
 *       )
 * ),
 */
class TokenController
{

}
