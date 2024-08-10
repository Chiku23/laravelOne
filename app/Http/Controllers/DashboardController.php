<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Define Functions
    public function index()
    {
        // Get the currently authenticated customer
        $customer = Auth::user(); // This assumes Customer is the authenticated user

        if ($customer) {
            // Pass the authenticated customer's data to the dashboard view
            return view('templates.dashboard', compact('customer'));
        } else {
            // If no customer is logged in, redirect to the login page or show an error
            return redirect()->route('login')->withErrors(['ErrorMSG' => 'You need to be logged in to access the dashboard.']);
        }
    }
}
