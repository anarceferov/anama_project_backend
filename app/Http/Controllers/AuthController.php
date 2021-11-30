<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;



class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|max:255'
        ]);

        if (!$token = Auth::attempt($request->only(['email', 'password'])))
            return $this->errorResponse(trans("responses.username_incorrect"));

        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }


    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function guard()
    {
        return Auth::guard();
    }
}
