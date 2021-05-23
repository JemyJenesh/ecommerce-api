<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller {
  public function __construct() {
    $this->middleware(['auth:sanctum'])->only('logout');
  }

  public function register(Request $request) {
    $credentials = $request->validate([
      'name' => 'required|min:3',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:8',
    ]);

    $user = User::create($credentials);
    $token = $user->createToken('auth-token')->plainTextToken;

    return response([
      'user' => $user,
      'token' => $token,
      'message' => 'Your profile has been created!',
      'errors' => false,
    ]);
  }

  public function login(Request $request) {
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (!auth()->attempt($credentials)) {
      return response([
        'message' => 'Invalid email or password!',
        'errors' => [
          'invalid' => 'Invalid email or password!',
        ],
      ], 422);
    }
    $token = auth()->user()->createToken('auth-token')->plainTextToken;

    return response([
      'user' => auth()->user(),
      'token' => $token,
      'message' => 'You have been logged in!',
      'errors' => false,
    ]);
  }

  public function logout(Request $request) {
    $request->user()->currentAccessToken()->delete();

    return response([
      'message' => 'You has been logged out!',
      'errors' => false,
    ]);
  }
}
