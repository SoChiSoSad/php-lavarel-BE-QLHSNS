<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('username', $request->username)->first();

        if ($user && $user->password === $request->password) {
            Auth::login($user);

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful!',
                'user' => new UserResource($user),
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Username or Password is wrong!',
        ], 401);
    }
}
