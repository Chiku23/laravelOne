<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

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
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'number' => 'required|string|min:10|max:15', // Adjusted validation for phone numbers
            'password' => 'required|string|min:8', // Added 'confirmed' rule for password confirmation
        ]);

        // Create a new customer
        $customer = new Customer;

        $customer->fullname = $request->input('fullname');
        $customer->email = $request->input('email');
        $customer->password = Hash::make($request->input('password')); // Hash the password
        $customer->number = $request->input('number');
        $customer->isAdmin = 0; // Default value for non-admin users
        $customer->save();

        // Redirect to the dashboard or login page after registration
        return redirect('/login')->with('success', 'Registration successful. Please log in.');
    }
}

