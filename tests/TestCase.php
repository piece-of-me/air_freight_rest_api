<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
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
