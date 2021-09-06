<?php

namespace App\Http\Controllers\API;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            $user = \Auth::user();
            $roleName = $user->role->name;
            $token = $user->createToken($roleName)->accessToken;

            return [
                'token' => $token,
            ];
        }

        return response()->json(['message'=>'Incorrect email or password'], HttpFoundationResponse::HTTP_UNAUTHORIZED);

    }
}
