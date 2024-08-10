<?php

use Illuminate\Support\Facades\Route;

// use Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;

// use Models
use App\Models\Customer;


// Website Routes
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::get('/about', [AboutController::class,'index'])->name('about');
Route::get('/contact', [ContactController::class,'index'])->name('contact');
Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
