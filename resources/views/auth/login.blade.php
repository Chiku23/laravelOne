@extends('layout.app')

@section('content')
<div class="LoginMain md:w-1/4 w-full mx-auto">
    <form action="{{ url('loginUser') }}" method="post" class="CustomForm flex flex-col mx-auto shadow-lg shadow-slate-500/20 mt-4 rounded p-4 bg-gray-800 mb-4 max-w-[350px]">
        {{-- Unique Form Token --}}
        @csrf
        <div class="FormTitle flex mx-auto justify-center font-bold">
            <h1 class="mb-4 text-2xl">Login</h1>
        </div>
        <div class="emailContainer relative flex items-center my-2">
            <label for="email" class="absolute pl-2 ml-2 text-sm text-slate-400 font-bold top-1/4 transition-all duration-500">Enter Email</label>
            <input class="rounded bg-transparent active:outline:none w-full focus:bg-transparent focus:outline-none" type="email" name="email" id="email" value="{{old('email')}}">
        </div>
        {{-- <span class="text-red-500">@error('email') {{$message}} @enderror</span> Already ToolTips Added --}}
        <div class="passwordContainer relative flex items-center my-2">
            <label for="password" class="absolute pl-2 ml-2 text-sm text-slate-400 font-bold top-1/4 transition-all duration-500">Enter Password</label>
            <input class="rounded bg-transparent active:outline:none w-full" type="password" name="password" id="password">
        </div>
        {{-- <span class="text-red-500">@error('password') {{$message}} @enderror</span> Already ToolTips Added --}}

        <div class="Actions mt-3 flex justify-center">
            <button type="submit" class="bg-green-500 px-5 py-2 rounded">Login</button>
        </div>
        <div class="registerUser text-center mt-2">
            Don't have a account Register? <a href="{{route('register')}}"><u class="text-blue-500">Here</u></a>
        </div>
    </form>
</div>
@endsection
