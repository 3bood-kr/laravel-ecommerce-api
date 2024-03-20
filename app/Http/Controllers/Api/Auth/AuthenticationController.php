<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Jiannei\Response\Laravel\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;

class AuthenticationController extends Controller
{

    public function register(){

    }
    public function login(LoginRequest $request){
        $credentials = $request->validated();
        if(!auth()->attempt($credentials, true)){
            Response::errorUnauthorized();
        }
        $token = auth()->user()->createToken(time())->plainTextToken;
        return Response::success([
            'user' => new UserResource(auth()->user()),
            'token' => $token,
        ]);

    }

    public function logout(Request $request){
        // Get bearer token from the request
        $accessToken = $request->bearerToken();
        // Get access token from database
        $token = PersonalAccessToken::findToken($accessToken);
        // Revoke token
        $token->delete();
    }

    public function logoutFromAllDevices(Request $request){
        auth()->user()->tokens()->delete();
    }
}
