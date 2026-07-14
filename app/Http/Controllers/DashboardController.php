<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blog;
use App\Models\Media;
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
        $request->validate([
            'title'          => 'required|max:255',
            'content'        => 'required',
            'thumbnailImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'thumbnailUrl'   => 'nullable|url|max:2048',
        ]);

        $resolvedThumbnail = null;

        // Priority 1: uploaded file takes precedence over URL
        if ($request->hasFile('thumbnailImage')) {
            // If updating, delete the old stored thumbnail (skip if it's an external URL)
            if ($request->editblogid && $existingBlog = Blog::find($request->editblogid)) {
                if ($existingBlog->thumbnail && !str_starts_with($existingBlog->thumbnail, 'http')) {
                    Storage::delete('public/' . $existingBlog->thumbnail);
                }
            }
            $resolvedThumbnail = $request->file('thumbnailImage')->store('blog-thumbnails', 'public');
        }
        // Priority 2: URL input (only when no file was uploaded)
        elseif ($request->filled('thumbnailUrl')) {
            $resolvedThumbnail = $request->input('thumbnailUrl');
        }

        // Handle updating an existing blog
        $blogID = $request->editblogid ?? null;
        if ($blogID) {
            $blog              = Blog::findOrFail($blogID);
            $blog->title       = $request->input('title');
            $blog->description = $request->input('content');
            // Keep the existing thumbnail if no new one was provided
            $blog->thumbnail   = $resolvedThumbnail ?? $blog->thumbnail;
            $blog->save();
            return redirect()->back()->with('status', 'Blog updated successfully!');
        }

        // Create a new blog post
        $blog              = new Blog();
        $blog->title       = $request->input('title');
        $blog->description = $request->input('content');
        $blog->thumbnail   = $resolvedThumbnail ?? '';
        $blog->created_by  = Auth::user()->user_id;
        $blog->save();

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
            $totalBlogs = $blogs->count();
            $totalComments = \App\Models\Comment::whereIn('blog_id', $blogs->pluck('id'))->count();

            return view('templates.dashboard-parts.user-blogs', compact('blogs','user','totalBlogs','totalComments'));
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

    // Media Library view page
    public function mediaLibrary()
    {
        $user = Auth::user();
        // Fetch all media uploaded by the user
        $mediaList = Media::where('user_id', $user->user_id)->orderBy('created_at', 'desc')->get();

        // Check attachments for each media item
        $mediaList->each(function ($media) {
            $attachedBlogs = collect();
            $path = $media->filepath; // e.g. media/filename.jpg
            $url = Storage::url($path);

            // Fetch all blogs
            $blogs = Blog::all();

            foreach ($blogs as $blog) {
                $isAttached = false;
                
                // Check if it is the blog's cover thumbnail
                if ($blog->thumbnail === $path) {
                    $isAttached = true;
                }
                // Check if it is embedded in description HTML
                elseif (str_contains($blog->description, $path) || ($url && str_contains($blog->description, $url))) {
                    $isAttached = true;
                }

                if ($isAttached) {
                    $attachedBlogs->push([
                        'id' => $blog->id,
                        'title' => $blog->title,
                    ]);
                }
            }

            $media->attached_blogs = $attachedBlogs;
        });

        return view('templates/dashboard-parts/media', compact('user', 'mediaList'));
    }

    // Media upload handler
    public function uploadMedia(Request $request)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB per image
        ]);

        $user = Auth::user();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Store file in 'public/media' folder
                $path = $file->store('media', 'public');

                Media::create([
                    'user_id' => $user->user_id,
                    'filename' => $file->getClientOriginalName(),
                    'filepath' => $path,
                    'mime_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }

            return redirect()->back()->with('status', 'Images uploaded successfully!');
        }

        return redirect()->back()->withErrors(['files' => 'No files uploaded.']);
    }

    // Media delete handler
    public function deleteMedia($id)
    {
        $media = Media::findOrFail($id);

        // Ensure authorization
        if ($media->user_id !== Auth::user()->user_id) {
            return redirect()->back()->withErrors(['error' => 'Unauthorized action!']);
        }

        // Delete from storage
        Storage::delete('public/' . $media->filepath);

        // Delete database record
        $media->delete();

        return redirect()->back()->with('status', 'Image deleted successfully!');
    }
}
