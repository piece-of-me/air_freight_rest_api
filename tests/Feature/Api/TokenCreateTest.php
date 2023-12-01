<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Tests\TestCase;

class TokenCreateTest extends TestCase
{
    public function test_that_token_creation_works_correct(): void
    {
        $user = User::factory()->make();
        $response = $this->post('/api/tokens/create', [
            'email' => $user->email,
            'password' => 'password_password',
        ]);
        $response
            ->assertUnprocessable()
            ->assertInvalid(['email' => 'Поле "email" должно существовать']);

        $user->save();
        $response = $this->post('/api/tokens/create', [
            'email' => $user->email,
            'password' => 'password_password',
        ]);
        $response
            ->assertOk()
            ->assertJsonStructure(['token']);
    }
}
