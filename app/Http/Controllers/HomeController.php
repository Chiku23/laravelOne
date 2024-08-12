<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class HomeController extends Controller
{
    //
    public function index(){

        //Get all Blogs
        $blogs = Blog::all();

        return view('index',compact('blogs'));
    }
}
