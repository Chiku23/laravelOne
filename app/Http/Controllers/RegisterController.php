<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    // Show the registration form
    public function index()
    {
        return view('auth.register'); // Ensure the view file is named correctly
    }

    // Handle the registration process
    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'number' => 'required|string|min:10|max:15', // Adjusted validation for phone numbers
            'password' => 'required|string|min:8|confirmed', // Added 'confirmed' rule for password confirmation
        ],
        [
            'email.unique' => 'This email is already registered. Please use a different one.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        // Create a new user
        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); // Hash the password
        $user->number = $request->input('number');
        $user->save();
        $request->session()->flash('success', 'User Registration successful. Please log in.');
        // Redirect to the dashboard or login page after registration
        return redirect('/login');
    }
}

