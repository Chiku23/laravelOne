<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class RegisterController extends Controller
{
    //
    public function index(){
        return view('auth/register');
    }
    public function register(Request $request){

        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'number' => 'required|min:10',
            'password' => 'required',
        ]);

        // Insert Data
        $customer = new Customer;

        $customer->fullname = $request['fullname'];
        $customer->email = $request['email'];
        $customer->password = $request['password'];
        $customer->number =  $request['number'];
        $customer->isAdmin = 0;
        $customer->save();

        return redirect('/dashboard');

    }

    

}
