<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['signin', 'signup']]);
    }
    public function signin(Request $request)
    {
        $fin = Validator::make(
            $request->all(),
            [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]
        );
        if ($fin->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $request->errors()->all(),
            ], 401);
        }
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email or password error',
            ], 401);
        }
        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'access_token' => $token
        ], 401);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Successfully logout'
            ]
        );
    }
    public function getUser()
    {
        $user = Auth::user();
        return response()->json(
            [
                'status' => 'success',
                'user' => $user
            ]
        );
    }
    public function signup(CreateAccount $request)
    {
        $usercreated = User::create($request->validated());
        $token = Auth::login($usercreated);
        return response()->json(
            [
                'user' => $usercreated,
                'access_token' => $token
            ]
        );
    }


}