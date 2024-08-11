@extends('templates/dashboard')

@section('dashboard-content')
@php
    // Get the user Data in the array
    $arrUser = $user->toArray(); 
    if(!empty($arrUser)){
        $strMainMessage = "User Logged In.";
    }else{
        $strMainMessage = "Not Logged.";
    } 

    $userName = $arrUser['name'];
    $userEmail = $arrUser['email'];
    $userNumber = $arrUser['number'];
@endphp
<div class="accountSettingMain w-1/2">
    <h2 class="text-xl font-bold mb-4">Account Settings</h2>
    <p class="my-2">Update your account informations below,</p>
    <!-- Form to update account Details-->
    <form action="{{ route('updateUser') }}" method="post" class="mt-2">
        @csrf
        <div class="formContent flex flex-col">
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{$userName}}" class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300">
            <label for="name">Email:</label>
            <input type="text" name="email" value="{{$userEmail}}" class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300">
            <label for="name">Phone:</label>
            <input type="text" name="number" value="{{$userNumber}}" class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300">
            <div class="Actions mt-3 flex">
                <button type="submit" class="bg-green-500 px-5 py-2 rounded">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection