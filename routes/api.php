<?php

use App\Http\Controllers\Api\AdvertisementController;
use App\Http\Controllers\Api\RegisteredUserController;
use App\Http\Controllers\Api\AuthenticatedSessionController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\HallController;
use App\Http\Controllers\Client\AvailableBookingTimeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Register new user
Route::post('register', [RegisteredUserController::class, 'store']);

// Login user
Route::post('login', [AuthenticatedSessionController::class, 'store']);

// Get all halls in a city
Route::get('/halls', [HallController::class, 'index']);

// Show specific hall
Route::get('/halls/{hall}', [HallController::class, 'show']);

// Get available booking times for a hall
Route::get('halls/{hall}/available-booking-times', AvailableBookingTimeController::class);

// Make a new booking
Route::post('/bookings', [BookingController::class, 'store']);

// Edit existing booking
Route::get('bookings/{booking}/edit', [BookingController::class, 'edit']);

// Update existing booking
Route::patch('/bookings/{booking}', [BookingController::class, 'update']);

// Delete existing booking
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy']);

// Get all advertisements
Route::get('/advertisements', AdvertisementController::class);
