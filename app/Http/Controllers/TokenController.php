<?php

namespace App\Http\Controllers;

use App\Http\Requests\Token\CreateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TokenController extends Controller
{
    public function __invoke(CreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        if (Auth::attempt($data)) {
            $token = $request->user()->createToken('token');
            return response()->json(['token' => $token->plainTextToken]);
        }
        return response()->json(status: Response::HTTP_UNAUTHORIZED);
    }
}
