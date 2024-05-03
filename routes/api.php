<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

    Route::get('/', function () {
        return response()->json([
            'message' => Str::upper('API_' . config('app.env') . '_ONLINE'),
            'database' => DB::connection()->getDatabaseName(),
        ]);
    });
});
