<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /*---------------------
    ***********************
    * Define Functions 
    ***********************
    -----------------------**/

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

    // Dashboard Update User Details page
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
            if(!$user->google_id){ // Dont let the google account users update their email
                $user->email = $request->input('email');
            }
            $user->number = $request->input('number');
            $user->save();

            // Put the logged in user details in session
            session()->put('user', [
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'number' => $user->number
            ]);

            // Redirect back with success message
            $request->session()->flash('status', 'User information updated successfully.');
            return redirect()->back();
        }else{
            // If no user is logged in, redirect to the login page or show an error
            return redirect()->route('login')->withErrors(['ErrorMSG' => 'You Are Not Logged In.']);
        }
    }

    // Dashboard Update User Password page
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

    // Update User Password
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
       return redirect()->back()->with('status', 'Password updated successfully.');
    }

    // Dashboard Add a Blog page
    public function addBlog(){
        $user = Auth::user();
        if(!$user){
            return redirect()->route('login')->withErrors(['ErrorMSG' => 'You Are Not Logged In.']);
        }
        return view('templates/dashboard-parts/addblog', compact('user'));
    }

    // Dashboard Add blog to DB
    public function publishBlog(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'thumbnailImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('thumbnailImage')) {
            // Delete old thumbnail if updating
            if ($request->editblogid && $blog = Blog::find($request->editblogid)) {
                Storage::delete('public/' . $blog->thumbnail);
            }
            // Store new thumbnail
            $path = $request->file('thumbnailImage')->store('blog-thumbnails', 'public');
            $validatedData['thumbnailImage'] = $path;
        }

        // get the blog id in case of edit blog
        $blogID = $request->editblogid ?? null;
        if($blogID){
            // Update existing blog
            $blog = Blog::findOrFail($blogID);
            // When editing blog if the input field for thumbnail is empty then assign the existing thumbnail and update the blog
            if(!isset($validatedData['thumbnailImage'])){
                $validatedData['thumbnailImage'] = $blog['thumbnail'];
            }

            $blog->title = $validatedData['title'];
            $blog->description = $validatedData['content'];
            $blog->thumbnail = $validatedData['thumbnailImage'];
            $blog->save();
            return redirect()->back()->with('status', 'Blog updated successfully!');
        }
        
        // Create a new blog post
        $blog = new Blog();
        $blog->title = $validatedData['title'];
        $blog->description = $validatedData['content'];
        $blog->thumbnail = $validatedData['thumbnailImage'];
        $blog->created_by = Auth::user()->user_id;
        $blog->save();

        // Redirect or return a response
        return redirect()->back()->with('status', 'Blog published successfully!');
    }

    // DashBoard Get the blogs published by the specific user
    public function getUsersBlogs(){
        // Get the currently authenticated user
        $user = Auth::user(); // This assumes user is the authenticated user
        if ($user) {
            $userId = Auth::user()->user_id;
            // Retrieve blogs related to the user
            $blogs = Blog::where('created_by', $userId)->orderBy('created_at', 'desc')->get();

            return view('templates.dashboard-parts.user-blogs', compact('blogs','user'));
        } else {
            // If no user is logged in, redirect to the login page or show an error
            return redirect()->route('login')->withErrors(['ErrorMSG' => 'You Are Not Logged In.']);
        }
    }
    // Delete a specific blog
    public function deleteBlog($id){
        $blog = Blog::find($id);

        if (!$blog) {
            return redirect()->back()->withErrors('ErrorMSG', 'Something Went Wrong!');
        }

        // Ensure only the blog owner can delete it
        if ($blog->created_by !== Auth::user()->user_id) {
            return redirect()->back()->withErrors('ErrorMSG', 'Unauthorized action!');
        }

        $blog->delete();
        
        return redirect()->back()->with('status', 'Blog deleted successfully!');
    }
    // Delete a specific blog
    public function editBlog(Request $request){
        $user = Auth::user();
        $blog = Blog::find($request->editblogid);

        if (!$blog) {
            return redirect()->back()->withErrors('ErrorMSG', 'Something Went Wrong!');
        }

        // Ensure only the blog owner can delete it
        if ($blog->created_by !== Auth::user()->user_id) {
            return redirect()->back()->withErrors('ErrorMSG', 'Unauthorized action!');
        }
        return view('templates/dashboard-parts/addblog', compact('user', 'blog'));
    }
}
