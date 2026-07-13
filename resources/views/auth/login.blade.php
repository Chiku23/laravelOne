@extends('layout.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen w-full py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <!-- Logo / Title -->
        <div class="text-center">
            <a href="{{ route('home') }}" class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400 hover:opacity-95 transition-opacity font-sans">
                Thought Threads
            </a>
            <h2 class="mt-6 text-2xl font-bold text-slate-800 dark:text-slate-200">Welcome Back</h2>
            <p class="mt-2 text-sm text-slate-550 dark:text-slate-400 font-sans">
                Please enter your details to sign in
            </p>
        </div>

        <!-- Form Card Container -->
        <div class="bg-white dark:bg-slate-900/40 backdrop-blur-xl border border-slate-200 dark:border-slate-850 p-8 rounded-3xl shadow-lg dark:shadow-2xl space-y-6">
            <form action="{{ url('loginUser') }}" method="post" class="space-y-5">
                @csrf
                
                <!-- Email Input -->
                <div class="space-y-1">
                    <label for="email" class="block text-sm font-semibold text-slate-650 dark:text-slate-300">Email Address</label>
                    <div class="relative">
                        <input class="w-full px-4 py-3 rounded-xl bg-slate-100/60 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-sm font-sans" 
                               type="email" name="email" id="email" value="{{old('email')}}" placeholder="you@example.com" required autocomplete="email">
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-1">
                    <div class="flex justify-between items-center">
                        <label for="password" class="block text-sm font-semibold text-slate-650 dark:text-slate-300">Password</label>
                    </div>
                    <div class="relative">
                        <input class="w-full px-4 py-3 rounded-xl bg-slate-100/60 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-sm font-sans" 
                               type="password" name="password" id="password" placeholder="••••••••" required autocomplete="current-password">
                    </div>
                </div>

                <!-- Actions -->
                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-650 hover:to-purple-755 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500/50 transition-all duration-200 transform active:scale-[0.98] shadow-md shadow-indigo-500/20">
                        Sign In
                    </button>
                </div>
            </form>

            <div class="relative flex py-2 items-center">
                <div class="flex-grow border-t border-slate-200 dark:border-slate-800/80"></div>
                <span class="flex-shrink mx-4 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Or continue with</span>
                <div class="flex-grow border-t border-slate-200 dark:border-slate-800/80"></div>
            </div>

            <!-- Social Button -->
            <div>
                <a href="{{ url('/auth/google') }}" class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-slate-205 dark:border-slate-800 rounded-xl bg-slate-50 dark:bg-slate-950/40 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-950/80 hover:text-slate-900 dark:hover:text-white transition-all text-sm font-semibold">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1" x="0px" y="0px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" class="w-5 h-5" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                        <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                        <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                        <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                    </svg>
                    <span>Google</span>
                </a>
            </div>

            <!-- Registration Redirect -->
            <div class="text-center text-sm">
                <span class="text-slate-500 dark:text-slate-400">Don't have an account?</span>
                <a href="{{route('register')}}" class="ml-1 font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 transition-colors">Register</a>
            </div>
        </div>
    </div>
</div>
@endsection
<x-error-popup :errors="$errors" :successMessage="session('status')"/>