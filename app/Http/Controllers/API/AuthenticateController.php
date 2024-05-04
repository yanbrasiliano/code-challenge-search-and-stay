<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;

class AuthenticateController extends Controller
{
  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {

      /**
       * @var \App\Models\User $user
       */

      $user = Auth::user();
      $token = $user->createToken('api-token')->plainTextToken;
      return response()->json(['token' => $token], 200);
    }

    throw ValidationException::withMessages([
      'email' => ['The provided credentials are incorrect.'],
    ]);
  }

  public function logout(Request $request)
  {
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Logged out successfully'], 200);
  }
}
