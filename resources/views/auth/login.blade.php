@extends('layout.app')

@section('content')
<div class="LoginMain">
    <div class="FormTitle w-1/2 flex mx-auto justify-center">
        <h1 class="mb-2 text-2xl">Login Form</h1>
    </div>
    <form action="{{ url('loginUser') }}" method="post" class="flex flex-col mx-auto p-5 w-1/4 border border-slate-400 m-4 rounded p-4">
        {{-- Unique Form Token --}}
        @csrf
        <label for="email">Enter Email</label>
        <input class="rounded bg-transparent active:outline:none" type="email" name="email" id="email" value="{{old('email')}}" class="form-control">
        <span class="text-red">@error('email') {{$message}} @enderror</span>

        <label for="password">Enter Password</label>
        <input class="rounded bg-transparent active:outline:none" type="password" name="password" id="password" class="form-control">
        <span class="text-red">@error('password') {{$message}} @enderror</span>

        <div class="Actions mt-3 flex justify-center">
            <button type="submit" class="bg-green-500 px-5 py-2 rounded">Login</button>
        </div>
    </form>
</div>

<x-error-popup :errors="$errors" :successMessage="session('success')"/>

@endsection
