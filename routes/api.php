<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\StoreController;

Route::prefix('v1')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

    Route::apiResource('books', BookController::class);
    Route::apiResource('stores', StoreController::class);

    Route::get('books/{bookId}/stores', [BookController::class, 'getStores']);
    Route::post('books/{bookId}/stores/{storeId}', [BookController::class, 'attachStore']);
    Route::delete('books/{bookId}/stores/{storeId}', [BookController::class, 'detachStore']);
    Route::get('stores/{storeId}/books', [StoreController::class, 'getBooks']);

    Route::get('/', function () {
        return response()->json([
            'message' => Str::upper('API_' . config('app.env') . '_ONLINE'),
            'database' => DB::connection()->getDatabaseName(),
        ]);
    });
});
