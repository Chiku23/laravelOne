<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    // Define Functions 
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user(); // This assumes user is the authenticated user
        Log::info('Check User', ['user', $user]);
        if ($user) {
            // Set a flash message
            session()->flash('success', '');
            // Pass the authenticated user's data to the dashboard view
            return view('templates.dashboard', compact('user'));
        } else {
            // If no user is logged in, redirect to the login page or show an error
            return redirect()->route('login')->withErrors(['ErrorMSG' => 'Please login before accessing DashBoard.']);
        }
    }
}
