@extends('layout.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen w-full py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <!-- Logo / Title -->
        <div class="text-center">
            <a href="{{ route('home') }}" class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 hover:opacity-95 transition-opacity font-sans">
                Thought Threads
            </a>
            <h2 class="mt-6 text-2xl font-bold text-slate-200">Create your account</h2>
            <p class="mt-2 text-sm text-slate-400">
                Join our community of thinkers and writers
            </p>
        </div>

        <!-- Form Card Container -->
        <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-850 p-8 rounded-3xl shadow-2xl space-y-6">
            <form action="{{ url('registerUser') }}" method="post" class="space-y-4" id="registerForm">
                @csrf
                
                <!-- Name -->
                <div class="space-y-1">
                    <label for="name" class="block text-sm font-semibold text-slate-300">Full Name <span class="text-rose-500">*</span></label>
                    <input class="w-full px-4 py-2.5 rounded-xl bg-slate-950/60 border border-slate-800 text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-sm" 
                           type="text" name="name" id="name" value="{{ old('name') }}" placeholder="John Doe" required autocomplete="name">
                    <span class="text-rose-400 text-xs font-semibold">@error('name') {{ $message }} @enderror</span>
                </div>

                <!-- Email -->
                <div class="space-y-1">
                    <label for="email" class="block text-sm font-semibold text-slate-300">Email Address <span class="text-rose-500">*</span></label>
                    <input class="w-full px-4 py-2.5 rounded-xl bg-slate-950/60 border border-slate-800 text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-sm" 
                           type="email" name="email" id="email" value="{{ old('email') }}" placeholder="john@example.com" required autocomplete="email">
                    <span class="errorbox text-rose-400 text-xs font-semibold">@error('email') {{ $message }} @enderror</span>
                </div>

                <!-- Phone -->
                <div class="space-y-1">
                    <label for="number" class="block text-sm font-semibold text-slate-300">Phone Number <span class="text-rose-500">*</span></label>
                    <input class="w-full px-4 py-2.5 rounded-xl bg-slate-950/60 border border-slate-800 text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-sm" 
                           type="text" name="number" id="number" value="{{ old('number') }}" placeholder="+1234567890" required>
                    <span class="errorbox text-rose-400 text-xs font-semibold">@error('number') {{ $message }} @enderror</span>
                </div>

                <!-- Password -->
                <div class="space-y-1">
                    <label for="password" class="block text-sm font-semibold text-slate-300">Password <span class="text-rose-500">*</span></label>
                    <input class="w-full px-4 py-2.5 rounded-xl bg-slate-950/60 border border-slate-800 text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-sm" 
                           type="password" name="password" id="password" placeholder="••••••••" required autocomplete="new-password">
                    <span class="errorbox text-rose-400 text-xs font-semibold">@error('password') {{ $message }} @enderror</span>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-1">
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-300">Confirm Password <span class="text-rose-500">*</span></label>
                    <input class="w-full px-4 py-2.5 rounded-xl bg-slate-950/60 border border-slate-800 text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-sm" 
                           type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" required autocomplete="new-password">
                    <span class="errorbox text-rose-400 text-xs font-semibold">@error('password_confirmation') {{ $message }} @enderror</span>
                </div>

                <!-- Actions -->
                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-650 hover:to-purple-755 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500/50 transition-all duration-200 transform active:scale-[0.98] shadow-lg shadow-indigo-500/20">
                        Register
                    </button>
                </div>
            </form>

            <div class="relative flex py-1 items-center">
                <div class="flex-grow border-t border-slate-800/80"></div>
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

            <!-- Login Redirect -->
            <div class="text-center text-sm">
                <span class="text-slate-500 dark:text-slate-400">Already registered?</span>
                <a href="{{ route('login') }}" class="ml-1 font-bold text-indigo-650 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 transition-colors">Login</a>
            </div>
        </div>
    </div>
</div>

@include('components.otp-modal')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all elements
    const registerForm = document.getElementById('registerForm');
    const otpModal = document.getElementById('otpModal');
    const otpForm = document.getElementById('otpForm');
    const otpError = document.getElementById('otpError');
    const resendOtpBtn = document.getElementById('resendOtp');
    const closeOtpModal = document.getElementById('closeOtpModal');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const errorboxes = document.querySelectorAll('.errorbox');

    // Enhanced fetch options
    const fetchOptions = {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            }
        };
    // Register form submission
    registerForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        try {
            const response = await fetch(this.action, {
                method: 'POST',
                ...fetchOptions,
                body: new FormData(this)
            });

            const data = await response.json();

            if (!response.ok) {
            // Handle validation errors
            if (data.errors) {
                // Reset the Error box each time the form is submitted
                errorboxes.forEach(box => {
                    box.innerHTML = '';  
                });
                for (const [field, messages] of Object.entries(data.errors)) {
                    const input = document.querySelector(`[name="${field}"]`);
                    if (input) {
                        // Find the error span right after this input
                        const errorSpan = input.nextElementSibling;
                        if (errorSpan && errorSpan.classList.contains('errorbox')) {
                            errorSpan.textContent = messages[0]; // Display the first error message
                        }
                    }
                }
            }
            throw new Error(data.message || 'Registration failed');
        }
            otpModal.classList.remove('hidden');
        } catch (error) {
            console.error('Registration error:', error);
        }
    });

    // OTP form submission
    otpForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        otpError.classList.add('hidden');
        
        try {
            const response = await fetch(this.action, {
                method: 'POST',
                ...fetchOptions,
                body: new FormData(this)
            });
            const data = await response.json();
            if (!response.ok) throw new Error(data.error || 'OTP verification failed');
            
            // Redirect to the intended page 'login' on success
            window.location.href = data.redirect; 
            
        } catch (error) {
            otpError.textContent = error.message;
            otpError.classList.remove('hidden');
        }
    });

    // Resend OTP
    resendOtpBtn.addEventListener('click', async function() {
        try {
            const response = await fetch('{{ route("resend.otp") }}', {
                method: 'GET',
                ...fetchOptions,
            });
            const data = await response.json();
            if (!response.ok) throw new Error(data.error || 'Failed to resend OTP');
            
        } catch (error) {
            otpError.textContent = error.message;
            otpError.classList.remove('hidden');
        }
    });

    // Close modal
    closeOtpModal.addEventListener('click', function() {
        otpModal.classList.add('hidden');
    });
});
</script>
@endsection