<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Show the registration form
    public function index()
    {
        session()->forget(['registration_data']);
        return view('auth.register'); // Ensure the view file is named correctly
    }

    // Handle the registration process
    public function register(Request $request)
    {
        try {
            // Validate the request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'number' => 'required|string|min:10|max:15', // Adjusted validation for phone numbers
                'password' => 'required|string|min:8|confirmed', // Added 'confirmed' rule for password confirmation
            ], [
                'email.unique' => 'This email is already registered. Please use a different one.',
                'password.confirmed' => 'The password confirmation does not match.',
            ]);
    
            // Generate OTP
            $otp = rand(100000, 999999);
    
            // Store data in session
            $request->session()->put('registration_data', [
                'name' => $request->name,
                'email' => $request->email,
                'number' => $request->number,
                'password' => $request->password,
                'otp' => $otp,
                'otp_expires_at' => now()->addMinutes(10)
            ]);
    
            Log::info("OTP for {$request->number}: $otp");
    
            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully',
                'otp' => $otp // Remove in production
            ]);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        }
    }
    

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric|digits:6']);

        $registrationData = $request->session()->get('registration_data');
        
        if (!$registrationData) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Session expired. Please register again.'], 400);
            }
            return redirect('/register')->with('error', 'Session expired. Please register again.');
        }

        if ($registrationData['otp'] != $request->otp) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Invalid OTP. Please try again.'], 400);
            }
            return back()->with('error', 'Invalid OTP. Please try again.');
        }

        if (now()->gt($registrationData['otp_expires_at'])) {
            if ($request->ajax()) {
                return response()->json(['error' => 'OTP has expired. Please request a new one.'], 400);
            }
            return back()->with('error', 'OTP has expired. Please request a new one.');
        }

        // Create user
        $user = User::create([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'password' => Hash::make($registrationData['password']),
            'number' => $registrationData['number'],
            'email_verified_at' => now()
        ]);
        
        // Clear session
        $request->session()->forget(['registration_data']);

        // Return json for the Script to handles further processing. after successful OTP verification
        return response()->json([
            'success' => true,
            'message' => 'OTP Verification Successful',
            'redirect' => url('/login')
        ]);
    }

    public function resendOtp(Request $request)
    {
        $registrationData = $request->session()->get('registration_data');
        
        if (!$registrationData) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Session expired. Please register again.'], 400);
            }
            return redirect('/register')->with('error', 'Session expired. Please register again.');
        }
    
        // Generate new OTP
        $newOtp = rand(100000, 999999);
        
        $registrationData['otp'] = $newOtp;
        $registrationData['otp_expires_at'] = now()->addMinutes(10);
        
        $request->session()->put('registration_data', $registrationData);
    
        Log::info("New OTP for {$registrationData['number']}: $newOtp");
    
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'A new OTP has been generated.',
                'otp' => $newOtp // Only include this for development
            ]);
        }
    
        return back()->with('success', 'A new OTP has been generated.');
    }
}

