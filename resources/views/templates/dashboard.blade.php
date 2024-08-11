@extends('layout.app')

@section('content')
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
<div class="DashboardMain w-full">
    <div class="ContainerTitle flex mx-auto mx-8 h-full">
        <div class="leftSidebar md:min-w-60 px-4 border-r">
            <div class="ActionGroup mt-4">
                <div class="Actions flex flex-col">
                    <a href="{{route('dashboard')}}" class="">
                        <div class="{{Request::routeIs('dashboard')?"bg-indigo-800": "border-transparent"}} actionItem px-4 py-2 border-l-4">My Blogs</div>
                    </a>
                    <a href="{{route('accountsetting')}}" class=""><div class="{{Request::routeIs('accountsetting')?"bg-indigo-800": "border-transparent"}} actionItem px-4 py-2 border-l-4">Account Settings</div></a>
                    <a href="{{route('updatepassword')}}" class=""><div class="{{Request::routeIs('updatepassword')?"bg-indigo-800": "border-transparent"}} actionItem px-4 py-2 border-l-4">Update Password</div></a>
                </div>
            </div>
        </div>
        <div class="RightMain px-4 flex-grow mt-4 mb-8">
            <div class="userWelCome my-2">
                Hello👋 <strong>{{$userName}}</strong>
                <hr>
            </div>
            <div class="Content">
                @yield('dashboard-content')
            </div> 
        </div>
    </div>
</div>
<x-error-popup :errors="$errors" :successMessage="session('success')"/>

@endsection
