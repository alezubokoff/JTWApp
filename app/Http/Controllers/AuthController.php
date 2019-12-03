<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = \request(['email', 'password']);
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
        ], 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logado()
    {
        return response()->json(['user' => auth()->guard('api')->user(0)], 200);
    }
}
