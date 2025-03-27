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
    <div class="ContainerTitle flex flex-col sm:flex-row mx-auto mx-8 h-full">
        <div class="leftSidebar px-4 border-r sm:w-1/4 pr-0">
            <div class="ActionGroup mt-4">
                <div class="Actions flex flex-col font-bold">
                    <a href="{{route('dashboard')}}" class="">
                        <div class="{{Request::routeIs('dashboard')?"bg-background": "border-transparent"}} actionItem px-4 py-2 border-l-4"><i class="fa-solid fa-blog"></i> My Blogs</div>
                    </a>
                    <a href="{{route('addblog')}}" class="">
                        <div class="{{Request::routeIs('addblog')?"bg-background": "border-transparent"}} actionItem px-4 py-2 border-l-4"><i class="fa-solid fa-file-circle-plus"></i> Add a Blog</div>
                    </a>
                    <a href="{{route('accountsetting')}}" class=""><div class="{{Request::routeIs('accountsetting')?"bg-background": "border-transparent"}} actionItem px-4 py-2 border-l-4"><i class="fa-solid fa-screwdriver-wrench"></i> Account Settings</div></a>
                    <a href="{{route('updatepassword')}}" class=""><div class="{{Request::routeIs('updatepassword')?"bg-background": "border-transparent"}} actionItem px-4 py-2 border-l-4"><i class="fa-solid fa-key"></i> Update Password</div></a>
                </div>
            </div>
        </div>
        <div class="RightMain px-4 pt-4 pb-8 sm:w-3/4">
            <div class="userWelCome py-2">
                Hello👋 <strong>{{$userName}}</strong>
                <hr>
            </div>
            <div class="DashboardContent">
                @yield('dashboard-content')
            </div> 
        </div>
    </div>
</div>
@endsection
