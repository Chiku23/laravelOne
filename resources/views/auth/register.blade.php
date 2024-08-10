@extends('layout.app')

@section('content')
<div class="RegistrationMain">
    <div class="FormTitle w-1/2 flex mx-auto justify-center">
        <h1 class="mb-2 text-2xl">Registration Form</h1>
    </div>
    <form action="{{url('registerUser')}}" method="post" class="flex flex-col mx-auto p-5 w-1/4 border border-slate-400 m-4 rounded p-4">
        @csrf
        <label for="fullname">Enter Name</label>
        <input class="rounded bg-transparent active:outline:none" type="text" name="fullname" id="fullname" value="{{old('fullname')}}" class="form-control">
        <span class="text-danger">@error('fullname') {{$message}} @enderror</span>

        <label for="email">Enter Email</label>
        <input class="rounded bg-transparent active:outline:none" type="email" name="email" id="email" value="{{old('email')}}" class="form-control">
        <span class="text-danger">@error('email') {{$message}} @enderror</span>

        <label for="number">Enter Phone</label>
        <input class="rounded bg-transparent active:outline:none" type="text" name="number" id="number" value="{{old('number')}}" class="form-control">
        <span class="text-danger">@error('number') {{$message}} @enderror</span>

        <label for="password">Enter Password</label>
        <input class="rounded bg-transparent active:outline:none" type="password" name="password" id="password" class="form-control">
        <span class="text-danger">@error('password') {{$message}} @enderror</span>

        <div class="Actions mt-3 flex justify-center">
            <button type="submit" class="bg-green-500 px-5 py-2 rounded">Register</button>
        </div>
    </form>
</div>
@endsection
