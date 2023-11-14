<?php

namespace App\Swagger\Requests\Token;

/**
 * @OA\Schema(
 *      title="CreateTokenRequest",
 *      description="Данные, необходимые для аутентификации",
 *      type="object",
 *      required={"email", "password"}
 * )
 */
class CreateTokenRequest
{
    /**
     * @OA\Property(
     *     title="email",
     *     description="E-mail пользователя",
     *     example="mail@mail.com"
     * )
     *
     * @var string
     */
    public string $email;

    /**
     * @OA\Property(
     *     title="password",
     *     description="Пароль пользователя",
     *     example="12345678910"
     * )
     *
     * @var string
     */
    public string $password;
}
