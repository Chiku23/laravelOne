@extends('layout.app')

@section('content')
<div class="head mt-6 p-4 font-mono capitalize text-3xl p-2 text-center items-center">
    <a href="{{ route('home') }}" class="w-full">Thought Threads</a>
</div>

<div class="LoginMain w-full sm:max-w-[50%] mx-auto  p-4 mt-4 text-black relative flex items-center">
    <form action="{{ url('loginUser') }}" method="post" class="CustomForm flex flex-col mx-auto shadow-lg shadow-slate-500/20 rounded p-4 bg-white w-full max-w-[400px] h-full justify-evenly">
        @csrf
        <div class="FormTitle flex mx-auto justify-center font-bold">
            <h1 class="mb-4 text-2xl">LOGIN</h1>
        </div>
        <div class="emailContainer relative flex items-center my-2">
            <label for="email" class="absolute pl-2 ml-2 text-sm text-black font-bold top-1/4 transition-all duration-500">Enter Email</label>
            <input class="rounded bg-transparent active:outline:none w-full focus:bg-transparent focus:outline-none" type="email" name="email" id="email" value="{{old('email')}}" autocomplete="true">
        </div>

        <div class="passwordContainer relative flex items-center my-2">
            <label for="password" class="absolute pl-2 ml-2 text-sm text-black font-bold top-1/4 transition-all duration-500">Enter Password</label>
            <input class="rounded bg-transparent active:outline:none w-full" type="password" name="password" id="password" autocomplete="false">
        </div>

        <div class="Actions mt-3 flex justify-center">
            <button type="submit" class="bg-green-500 px-5 py-2 rounded border-2 border-green-500 hover:border-green-900 hover:bg-green-600 font-bold text-black hover:text-white">Login</button>
        </div>
        <div class="registerUser text-center mt-2">
            Don't have an account Register? <a href="{{route('register')}}"><u class="text-blue-500">Here</u></a>
        </div>
        <a href="{{ url('/auth/google') }}" class="border-2 border-white mt-4 flex items-center justify-center border-2 border-black">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1" x="0px" y="0px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" class="w-5 h-5" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12
                c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24
                c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657
                C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36
                c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571
                c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path></svg>
                <span class="p-2">Login with Google</span>
        </a>        
    </form>
</div>
@endsection
<x-error-popup :errors="$errors" :successMessage="session('status')"/>