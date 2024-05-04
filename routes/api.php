<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
  Route::post('login', [\App\Http\Controllers\API\AuthenticateController::class, 'login']);
  
  Route::get('/', function () {
    return response()->json([
      'message' => Str::upper('API_' . config('app.env') . '_ONLINE'),
      'database' => DB::connection()->getDatabaseName(),
    ]);
  });

  Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [\App\Http\Controllers\API\AuthenticateController::class, 'logout']);

    Route::apiResource('books', \App\Http\Controllers\API\BookController::class);
    Route::apiResource('stores', \App\Http\Controllers\API\StoreController::class);

    Route::get('books/{bookId}/stores', [\App\Http\Controllers\API\BookController::class, 'getStores']);
    Route::post('books/{bookId}/stores/{storeId}', [\App\Http\Controllers\API\BookController::class, 'attachStore']);
    Route::delete('books/{bookId}/stores/{storeId}', [\App\Http\Controllers\API\BookController::class, 'detachStore']);
    Route::get('stores/{storeId}/books', [\App\Http\Controllers\API\StoreController::class, 'getBooks']);

    Route::get('/user', function (Request $request) {
      return $request->user();
    });
  });
});
