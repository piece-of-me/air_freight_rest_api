<?php

namespace App\Swagger;

/**
 * @OA\Info(
 *     title="Airfreight REST API",
 *     version="1.0.0"
 * ),
 * @OA\PathItem(
 *     path="/api/"
 * ),
 * @OA\SecurityScheme (
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="bearer",
 *     in="header",
 *     name="Authorization"
 * )
 */
class Main
{
}
