<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DropdownController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::post('/send-otp', [OtpController::class, 'sendOtp']);
Route::post('/verify-otp', [OtpController::class, 'verifyOtp']);

Route::get('/police-unit-types', [DropdownController::class, 'unitTypes']);
Route::get('/police-units/{type}', [DropdownController::class, 'unitsByType']);
Route::get('/police-stations/{unitId}', [DropdownController::class, 'policeStations']);
Route::get('/complaint-types', [DropdownController::class, 'complaintTypes']);

/*
|--------------------------------------------------------------------------
| Protected Routes (Login Required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum'])->group(function () {

    // Logged-in user info
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //  Complaint Routes
    Route::post('/complaint', [ComplaintController::class, 'store']);
    Route::get('/my-complaints', [ComplaintController::class, 'myComplaints']);


    // Add This For Track Status
    Route::get('/complaint/{id}', [ComplaintController::class, 'show']);


    /*
    |--------------------------------------------------------------------------
    | Role Based Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin-dashboard', [AdminController::class, 'index']);
    });

    Route::middleware('role:police')->group(function () {
        Route::get('/police-dashboard', function () {
            return response()->json(['message' => 'Police Dashboard']);
        });
    });

    Route::middleware('role:citizen')->group(function () {
        Route::get('/citizen-dashboard', function () {
            return response()->json(['message' => 'Citizen Dashboard']);
        });
    });

});
