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
    $userGoogleID = $arrUser['google_id'] ?? '';

@endphp
<div class="accountSettingMain sm:w-1/2">
    <h2 class=" font-bold mb-4 text-2xl border-b border-slate-400 pb-2">Account Settings</h2>
    <p class="my-2">Update your account informations below,</p>
    <!-- Form to update account Details-->
    <form action="{{ route('updateUser') }}" method="post" class="mt-2">
        @csrf
        <div class="formContent flex flex-col">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{$userName}}" class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 my-2" autocomplete="true">
            <label for="email" class="{{($userGoogleID) ? 'opacity-[0.5]' : '' }}">Email: </label>
            <input type="text" id="email" name="email" value="{{$userEmail}}" class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 my-2 {{($userGoogleID) ? 'opacity-[0.5]' : '' }}" {{($userGoogleID) ? 'readonly' : '' }} autocomplete="true">
            @php echo ($userGoogleID) ? '<p class="text-sm opacity-[0.5] mb-2">You can not update your email.</p>' : ''; @endphp
            <label for="number">Phone:</label>
            <input type="text" id="number" name="number" value="{{$userNumber}}" class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 my-2">
            <div class="Actions mt-3 flex">
                <button type="submit" class="bg-green-500 px-5 py-2 rounded">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection