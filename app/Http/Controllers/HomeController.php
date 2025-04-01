<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(Request $request){

        $query = Blog::with('user');
        // Check if an author name is provided
        // Filter the Blogs based on a author
        if ($request->has('author') && !empty($request->author)) {
            $authorName = $request->author;
            $query->whereHas('user', function ($q) use ($authorName) {
                $q->where('name', 'like', '%' . $authorName . '%'); // Use 'like' for partial matching
            });
        }

        //Get all Blogs
        $blogs = $query->orderBy('created_at', 'desc')->get();

        return view('index',compact('blogs'));
    }
}
