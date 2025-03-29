<?php

use Illuminate\Support\Facades\Route;

// use Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\GoogleController;
// User Admin Controllers
use App\Http\Controllers\Admin\AdminController;

/*------------------------
***************************
** Website Routes
***************************
--------------------------*/

// Homepage Route
Route::get('/', [HomeController::class,'index'])->name('home');

// Google Logic Routes

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Login Form Routes and Authentication
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/loginUser', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Route
Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::post('/registerUser', [RegisterController::class, 'register']);

Route::get('/about', [AboutController::class,'index'])->name('about');
Route::get('/contact', [ContactController::class,'index'])->name('contact');

Route::prefix('dashboard')->group(function(){
    Route::get('/', [DashboardController::class,'getUsersBlogs'])->name('dashboard');

    Route::get('/account-setting', [DashboardController::class,'accountSetting'])->name('accountsetting');
    Route::post('/account-setting/updateUser', [DashboardController::class,'updateUser'])->name('updateUser');

    Route::get('/add-blog', [DashboardController::class,'addBlog'])->name('addblog');
    Route::post('/add-blog/publishBlog', [DashboardController::class,'publishBlog'])->name('publishBlog');

    Route::get('/update-password', [DashboardController::class,'updatePassword'])->name('updatepassword');
    Route::post('/update-password/updateUserPassword', [DashboardController::class,'updateUserPassword'])->name('updateUserPassword');

    Route::delete('/delete-blog/{id}', [DashboardController::class, 'deleteBlog'])->name('blog.delete');
    Route::post('/add-blog', [DashboardController::class, 'editBlog'])->name('blog.edit');
});

/*------------------------
***************************
** Admin Routes
***************************
--------------------------*/

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'adminpanel'])->name('admin.dashboard');
});