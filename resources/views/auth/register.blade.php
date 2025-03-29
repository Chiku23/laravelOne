@extends('layout.app')

@section('content')
<div class="RegistrationMain md:w-1/3 w-full mx-auto">
    <div class="FormTitle flex mx-auto justify-center font-bold">
        <h1 class="mb-2 text-2xl pt-2">Registration Form</h1>
    </div>
    <form action="{{ url('registerUser') }}" method="post" class="flex flex-col mx-auto shadow-lg shadow-slate-500/20 mt-4 rounded p-4 bg-gray-800 mb-4 max-w-[350px]">
        @csrf
        
        <label for="name" class="mb-2 mt-4 flex items-center">
            <span class="mr-1">Enter Your Name</span>
            <span class="text-red-500">*</span> <!-- Asterisk for required -->
        </label>
        <input class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300" type="text" name="name" id="name" value="{{ old('name') }}" required autocomplete="true">
        <span class="text-red-500">@error('name') {{ $message }} @enderror</span>

        <label for="email" class="mb-2 mt-4 flex items-center">
            <span class="mr-1">Enter Your Email</span>
            <span class="text-red-500">*</span> <!-- Asterisk for required -->
        </label>
        <input class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300" type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="true">
        <span class="text-red-500">@error('email') {{ $message }} @enderror</span>

        <label for="number" class="mb-2 mt-4 flex items-center">
            <span class="mr-1">Enter Phone</span>
            <span class="text-red-500">*</span> <!-- Asterisk for required -->
        </label>
        <input class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300" type="text" name="number" id="number" value="{{ old('number') }}" required>
        <span class="text-red-500">@error('number') {{ $message }} @enderror</span>

        <label for="password" class="mb-2 mt-4 flex items-center">
            <span class="mr-1">Enter Password</span>
            <span class="text-red-500">*</span> <!-- Asterisk for required -->
        </label>
        <input class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300" type="password" name="password" id="password" required autocomplete="false">
        <span class="text-red-500">@error('password') {{ $message }} @enderror</span>

        <label for="password_confirmation" class="mb-2 mt-4 flex items-center">
            <span class="mr-1">Confirm Password</span>
            <span class="text-red-500">*</span> <!-- Asterisk for required -->
        </label>
        <input class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300" type="password" name="password_confirmation" id="password_confirmation" required autocomplete="false">
        <span class="text-red-500">@error('password_confirmation') {{ $message }} @enderror</span>

        <div class="Actions mt-3 flex justify-center">
            <button type="submit" class="bg-green-500 px-5 py-2 rounded">Register</button>
        </div>
        <div class="registerUser text-center mt-2">
            Already Registered? Login <a href="{{ route('login') }}"><u class="text-blue-500">Here</u></a>
        </div>
        <a href="{{ url('/auth/google') }}" class="border-2 border-white mt-2 p-2 flex items-center justify-center">
            <i class="fa-brands fa-google pr-2"></i> Sign-Up with Google
        </a>   
    </form>
</div>
@endsection