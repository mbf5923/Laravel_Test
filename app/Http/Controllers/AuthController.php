<?php


namespace App\Http\Controllers;


use App\Traits\FailedResponseTrait;
use App\Traits\SuccessResponseTrait;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController
{
    use FailedResponseTrait,SuccessResponseTrait;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $jwt_token = null;

        if (!$jwt_token = $this->guard()->attempt($credentials)) {

            return $this->failedResponse('Invalid username or Password',Response::HTTP_UNAUTHORIZED);

        }

        return $this->tokenResponse($jwt_token);
    }



    /**
     * Get the guard to be used during authentication.
     *
     * @return Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
