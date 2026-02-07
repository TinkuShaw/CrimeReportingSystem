<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Otp;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class OtpController extends Controller
{
    // Send OTP to user's email
    public function sendOtp(Request $request)
    {
        // Validate email
        $request->validate([
            'email' => 'required|email'
        ]);

        // Generate OTP
        $otp = rand(100000, 999999);

        // Store OTP with 5 minutes expiry
        Otp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(5)
            ]
        );

        // Send OTP via email
        Mail::to($request->email)->queue(new OtpMail($otp));

        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully.'
        ]);
    }

    // Verify OTP and authenticate user
    public function verifyOtp(Request $request)
    {
        // Validate request
        $request->validate([
            'email'  => 'required|email',
            'name'   => 'nullable|string',
            'mobile' => 'nullable|string',
            'otp'    => 'required'
        ]);

        // Find matching OTP record
        $record = Otp::where('email', $request->email)
                     ->where('otp', $request->otp)
                     ->first();

        // Check OTP validity and expiration
        if (!$record || Carbon::now()->gt($record->expires_at)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP.'
            ], 401);
        }

        // Get existing user (if any)
        $existingUser = User::where('email', $request->email)->first();

        // Create or update user
        $user = User::updateOrCreate(
            ['email' => $request->email],
            [
                'name'   => $request->name ?? ($existingUser->name ?? 'User'),
                'mobile' => $request->mobile ?? ($existingUser->mobile ?? null),
                'role'   => $existingUser ? $existingUser->role : 'citizen',
            ]
        );

        // Generate API token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Remove OTP after successful verification
        $record->delete();

        return response()->json([
            'success' => true,
            'token'   => $token,
            'user'    => $user
        ]);
    }
}