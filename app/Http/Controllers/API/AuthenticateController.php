<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateController extends Controller
{
  public function login(LoginRequest $request)
  {
    if (Auth::attempt($request->only('email', 'password'))) {

      /**
       * @var \App\Models\User $user
       */

      $user = Auth::user();
      $token = $user->createToken('api-token')->plainTextToken;

      return response()->json([
        'message' => 'Authenticated successfully',
        'user' => $user,
        'token' => $token
      ], Response::HTTP_OK);
    }

    return response()->json([
      'message' => 'The provided credentials are incorrect.'
    ], Response::HTTP_UNAUTHORIZED);
  }

  public function logout(Request $request)
  {
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Logged out successfully'], Response::HTTP_OK);
  }
}
