<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    public function viewBlog(Request $request){
        $blog = Blog::find($request->id);
        $comments = Comment::where('blog_id', $request->id)->orderBy('created_at', 'desc')->get();
        return view('templates/blogs/view-blog', compact('blog', 'comments'));
    }

    public function addComment(Request $request){

        $blog = Blog::find($request->id);
        if (!$blog) {
            return redirect()->back()->withErrors('ErrorMSG', 'Something Went Wrong!');
        }
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->withErrors(['ErrorMSG' => 'You Are Not Logged In.']);
        }

        // Validate the form data
        $validatedData = $request->validate([
            'usercomment' => 'required',
        ]);

        // Create a new blog post
        $blog = Blog::find($request->id);
        $comment = new Comment();
        $comment->comment = $request->input('usercomment');
        $comment->blog_id = $blog->id;
        $comment->created_by = Auth::user()->user_id;
        $comment->save();
        return redirect()->back();
    }
}
