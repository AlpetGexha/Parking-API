<?php

use App\Http\Controllers\Api\ParkingController;
use App\Http\Controllers\Api\ReservationApiController;
use App\Http\Controllers\Api\VehiclesController;
use App\Http\Controllers\Api\ZoneController;
use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::post('auth/register', RegisteredUserController::class)->name('user.register');
Route::post('auth/login', LoginUserController::class)->name('login');

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('vehicles', VehiclesController::class);

    Route::get('zones', ZoneController::class)->name('zone');

    Route::group(['controller' => ParkingController::class, 'as' => 'parkings.', 'prefix' => 'parkings'], function () {
        Route::post('start', 'start')->name('start');
        Route::get('{parking}', 'show')->name('show');
        Route::put('{parking}', 'stop')->name('stop');
    });

    Route::group([
        'controller' => ReservationApiController::class,
        'as' => 'reservations',
        'prefix' => 'reservations',
    ], function () {
        Route::get('index', 'index')->name('index');
        Route::get('show', 'show')->name('show');
        Route::post('store', 'store')->name('store');
        Route::post('update/{reservation}', 'update')->name('update');
        Route::delete('delete/{reservation}', 'delete')->name('delete');

        Route::post('reject/{id}', 'reject')->name('reject')->scopeBindings();
        Route::post('confirm/{id}', 'confirm')->name('confirm')->scopeBindings();
        Route::post('cancel/{id}', 'cancel')->name('cancel')->scopeBindings();
    });
});
