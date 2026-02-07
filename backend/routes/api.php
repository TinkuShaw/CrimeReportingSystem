<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\OtpController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->group(function () {

    // Logged-in user info
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Admin Route
    Route::middleware('role:admin')->get('/admin-dashboard', [AdminController::class,'index']);

    // Police Route
    Route::middleware('role:police')->get('/police-dashboard', function () {
        return "Police Dashboard";
    });

    // Citizen Route
    Route::middleware('role:citizen')->get('/citizen-dashboard', function () {
        return "Citizen Dashboard";
    });
});

Route::post('/send-otp', [OtpController::class, 'sendOtp']);
Route::post('/verify-otp', [OtpController::class, 'verifyOtp']);