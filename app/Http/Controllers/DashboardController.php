<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    // Define Functions 
    public function index(){
        // Get the currently authenticated user
        $user = Auth::user(); // This assumes user is the authenticated user
        if ($user) {
            // Set a flash message
            session()->flash('success', '');
            // Pass the authenticated user's data to the dashboard view
            return view('templates.dashboard', compact('user'));
        } else {
            // If no user is logged in, redirect to the login page or show an error
            return redirect()->route('login')->withErrors(['ErrorMSG' => 'You Are Not Logged In.']);
        }
    }

    // Dashboard user Account Settings page
    public function accountSetting(){
        $user = Auth::user(); // This assumes user is the authenticated user
        if ($user) {
            // Pass the authenticated user's data to the dashboard view
            return view('templates/dashboard-parts/account-setting', compact('user'));
        } else {
            // If no user is logged in, redirect to the login page or show an error
            return redirect()->route('login')->withErrors(['ErrorMSG' => 'You Are Not Logged In.']);
        }
    }
    public function updateUser(Request $request){
        $user = Auth::user();

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
            'number' => 'required|numeric|min:99|max:9999999999', // Adjusted validation for phone numbers
        ],
        [
            'email.unique' => 'This email is already registered. Please use a different one.',
            'number.numeric' => 'The Number field should contain only numbers.', 
            'number.min' => 'The Number must be at least 3 digits.', // Optional: Adjust based on your requirements
            'number.max' => 'The Number must not exceed 10 digits.', // Optional: Adjust based on your requirements
        ]);
        
        if($user){
            // Update user details
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->number = $request->input('number');
            $user->save();
    
            // Redirect back with success message
            return redirect()->back()->with('success', 'User information updated successfully.');
        }else{
            // If no user is logged in, redirect to the login page or show an error
            return redirect()->route('login')->withErrors(['ErrorMSG' => 'You Are Not Logged In.']);
        }
    }
    public function updatePassword(){
        $user = Auth::user();
        if ($user) {
            // Pass the authenticated user's data to the dashboard view
            return view('templates/dashboard-parts/update-password', compact('user'));
        } else {
            // If no user is logged in, redirect to the login page or show an error
            return redirect()->route('login')->withErrors(['ErrorMSG' => 'You Are Not Logged In.']);
        }
    }
    public function updateUserPassword(Request $request){
        $user = Auth::user();

        // Validate the request data
        $request->validate([
            'password' => 'required|string|max:255', // Current password
            'newpassword' => 'required|string|min:8|confirmed', // New password
        ],
        [
            'newpassword.confirmed' => 'The confirm password does not match.'
        ]);

        // Check if the current password is correct
        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Current password is incorrect.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->input('newpassword'));
        $user->save();

       // Redirect back with success message
       return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
