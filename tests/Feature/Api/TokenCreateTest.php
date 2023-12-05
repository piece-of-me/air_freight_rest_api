<?php

namespace Tests\Feature\Api;

use App\Models\User;

class TokenCreateTest extends ApiTestCase
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
