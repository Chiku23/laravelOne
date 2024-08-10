<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class DashboardController extends Controller
{
    //Define Functions
    public function index(){
        // return 'Fron Index Functoion in DashboardController';

        $customer = Customer::all();

        $data = compact('customer');

        return view('templates/dashboard')->with($data);
    }
}
