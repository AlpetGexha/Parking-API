<?php

use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\VehiclesController;
use Illuminate\Support\Facades\Route;

Route::post('auth/register', [RegisteredUserController::class, 'store'])->name('user.register');
Route::post('auth/login', LoginUserController::class);

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('vehicles', VehiclesController::class);
});
