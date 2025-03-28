<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    // Redirect to Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google Callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if user already exists
            $user = User::where('email', $googleUser->email)->first();



            try {
                if (!$user) {
                    // Create new user
                    $user = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'avatar' => $googleUser->avatar,
                        'password' => bcrypt('random-password') // Not used, just a placeholder
                    ]);
                    Log::info('New user created via Google login', ['email' => $googleUser->email]);
                }else{
                    Log::info('User logged in using Google login', ['email' => $googleUser->email]);
                }
            } catch (\Throwable $th) {
                Log::error('Error creating user via Google login', [
                    'error' => $th->getMessage(),
                    'trace' => $th->getTraceAsString(),
                    'google_id' => $googleUser->id ?? null,
                    'email' => $googleUser->email ?? null,
                ]);
                return redirect()->route('login')->with('error', 'Google login failed');
            }

            // Log the user in
            Auth::login($user);

           // Put the logged in user details in session
            session()->put('user', [
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'number' => $user->number
            ]);
            // Redirect to intended URL
            return redirect()->intended('dashboard')->with('status', 'Welcome...!');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google login failed');
        }
    }
}
