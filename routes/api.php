<?php

use App\Http\Controllers\API\AdvertisementController;
use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\RegisteredUserController;
use App\Http\Controllers\API\AuthenticatedSessionController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\HallController;
use App\Http\Controllers\Client\AvailableBookingTimeController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api.'], function () {
    Route::resource('users', AuthAPIController::class);
    Route::post('auth/login', [AuthAPIController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('auth/user', [AuthAPIController::class, 'user']);
        Route::post('auth/logout', [AuthAPIController::class, 'logout']);
        Route::post('auth/token', [AuthAPIController::class, 'checkToken']);
        Route::patch('auth/users', [AuthAPIController::class, 'updateUser']);


// Get all halls in a city
        Route::apiResource('/halls', HallController::class)->except(['store', 'destroy']);
// Get available booking times for a hall
        Route::get('halls/{hall}/available-booking-times', AvailableBookingTimeController::class);

// Make a new booking
        Route::apiResource('/bookings', BookingController::class);

// Get all advertisements
        Route::apiResource('/advertisements', AdvertisementController::class);

        //FCM

        Route::group(['prefix' => 'fcm'], function () {

            Route::post('set_token', [\App\Http\Controllers\API\FirebaseAPIController::class, 'setToken']);
            Route::post('set_topics', [\App\Http\Controllers\API\FirebaseAPIController::class, 'setTopics']);

        });

    });

});