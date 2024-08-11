<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Show the login form
    public function index()
    {
        return view('auth.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Create a User object and retrieve the user by email
        $user = new User(); // Create a new User instance
        $user = $user->where('email', $request->email)->first(); // Retrieve the user

        if (!$user) {
            // User not found
            return back()->withErrors([
                'ErrorMSG' => 'User not found.',
            ]);
        }

        // Check if the password is correct
        if (!Hash::check($request->password, $user->password)) {
            // Password is incorrect
            return back()->withErrors([
                'ErrorMSG' => 'Password is incorrect.',
            ]);
        }

        // Log in the user
        Auth::login($user);

        // Log the successful login attempt
        Log::info('User logged in', ['email' => $user->email]);

        // Redirect to intended URL
        return redirect()->intended('dashboard');
    }

    // Handle logout request
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/'); // Redirect to homepage or another appropriate route
    }
}