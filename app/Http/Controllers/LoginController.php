<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    // Show the login form
    public function index()
    {
        return view('auth.login'); // Ensure the view file is named correctly
    }

    // Handle login request
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');

        Log::info('Login attempt', ['attempt', Auth::attempt($credentials)]);
        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('dashboard'); // Redirect to dashboard or intended URL
        }
        
        // Authentication failed
        return back()->withErrors([
            'ErrorMSG' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle logout request
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/'); // Redirect to homepage or another appropriate route
    }
}
