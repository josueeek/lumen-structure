<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $this->validate(
            $request,
            [
                'username'  => 'required|email',
                'password'  => 'required|string'
            ]
        );

        $credentials = $request->only(['username', 'password']);
        if ($token = Auth::attempt($credentials)) {
            return $this->_respondWithToken($token);
        }

        return response()->json(
            ['error' => 'Usuário e/ou senha inválidos!'],
            401
        );
    }

    public function me()
    {
        return response()->json(Auth::user());
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Deslogado com sucesso!']);
    }

    public function refresh()
    {
        return $this->_respondWithToken(Auth::refresh());
    }

    private function _respondWithToken($token)
    {
        return response()->json(
            [
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL()
            ],
            200
        );
    }
}
