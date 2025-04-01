@extends('layout.app')

@section('content')
<div class="head mt-6 p-4 font-mono capitalize text-3xl p-2 text-center items-center">
    <a href="{{ route('home') }}" class="w-full">Thought Threads</a>
</div>

<div class="RegistrationMain md:w-1/3 w-full mx-auto">

    <form action="{{ url('registerUser') }}" method="post" class="flex flex-col mx-auto shadow-lg shadow-slate-500/20 mt-4 rounded p-4 mb-4 max-w-[350px] bg-white text-black" id="registerForm">
        @csrf
        <div class="FormTitle flex mx-auto justify-center font-bold">
            <h1 class="mb-2 text-2xl pt-2">Registration Form</h1>
        </div>
        <label for="name" class="mb-2 mt-2 flex items-center">
            <span class="mr-1">Enter Your Name</span>
            <span class="text-red-500">*</span> <!-- Asterisk for required -->
        </label>
        <input class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300" type="text" name="name" id="name" value="{{ old('name') }}" required autocomplete="first_name">
        <span class="text-red-500">@error('name') {{ $message }} @enderror</span>

        <label for="email" class="mb-2 mt-2 flex items-center">
            <span class="mr-1">Enter Your Email</span>
            <span class="text-red-500">*</span> <!-- Asterisk for required -->
        </label>
        <input class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300" type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email">
        <span class="errorbox text-red-500">@error('email') {{ $message }} @enderror</span>

        <label for="number" class="mb-2 mt-2 flex items-center">
            <span class="mr-1">Enter Phone</span>
            <span class="text-red-500">*</span> <!-- Asterisk for required -->
        </label>
        <input class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300" type="text" name="number" id="number" value="{{ old('number') }}" required>
        <span class="errorbox text-red-500">@error('number') {{ $message }} @enderror</span>

        <label for="password" class="mb-2 mt-2 flex items-center">
            <span class="mr-1">Enter Password</span>
            <span class="text-red-500">*</span> <!-- Asterisk for required -->
        </label>
        <input class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300" type="password" name="password" id="password" required autocomplete="false">
        <span class="errorbox text-red-500">@error('password') {{ $message }} @enderror</span>

        <label for="password_confirmation" class="mb-2 mt-2 flex items-center">
            <span class="mr-1">Confirm Password</span>
            <span class="text-red-500">*</span> <!-- Asterisk for required -->
        </label>
        <input class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300" type="password" name="password_confirmation" id="password_confirmation" required autocomplete="false">
        <span class="errorbox text-red-500">@error('password_confirmation') {{ $message }} @enderror</span>

        <div class="Actions mt-3 flex justify-center">
            <button type="submit" class="bg-green-500 px-5 py-2 rounded border-2 border-green-500 hover:border-green-900 hover:bg-green-600 font-bold text-black hover:text-white">Register</button>
        </div>
        <div class="registerUser text-center mt-2">
            Already Registered? Login <a href="{{ route('login') }}"><u class="text-blue-500">Here</u></a>
        </div>
        <a href="{{ url('/auth/google') }}" class="border-2 border-white mt-4 flex items-center justify-center border-2 border-black">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1" x="0px" y="0px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" class="w-5 h-5" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12
                c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24
                c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657
                C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36
                c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571
                c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path></svg>
                <span class="p-2">SignUp with Google</span>
        </a>        
    </form>
</div>

@include('components.otp-modal')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all elements
    const registerForm = document.getElementById('registerForm');
    const otpModal = document.getElementById('otpModal');
    const otpForm = document.getElementById('otpForm');
    const otpError = document.getElementById('otpError');
    const displayOtp = document.getElementById('displayOtp');
    const resendOtpBtn = document.getElementById('resendOtp');
    const closeOtpModal = document.getElementById('closeOtpModal');
    const csrfToken = document.querySelector('input[name="_token"]').value;
    const errorboxes = document.querySelectorAll('.errorbox');


    // Register form submission
    registerForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        try {
            const response = await fetch(this.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: new FormData(this)
            });
            
            const data = await response.json();
            console.log(data.errors);
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
            // Show OTP modal with the received OTP (for development)
            otpModal.classList.remove('hidden');
            displayOtp.textContent = data.otp;
            document.getElementById('otpMessage').classList.remove('hidden');
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
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
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
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            const data = await response.json();
            if (!response.ok) throw new Error(data.error || 'Failed to resend OTP');
            // Update displayed OTP
            displayOtp.textContent = data.otp;
            
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