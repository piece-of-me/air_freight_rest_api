<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

abstract class ApiTestCase extends TestCase
{
    use WithFaker;
    use DatabaseMigrations;

    protected ?string $token = null;

    protected function getBearerToken(): string
    {
        if (!$this->token) {
            $user = User::factory()->create();
            $this->token = 'Bearer ' . $user->createToken('token')->plainTextToken;
        }
        return $this->token;
    }
}
