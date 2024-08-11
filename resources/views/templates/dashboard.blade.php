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


<div class="DashboardMain">
    <div class="ContainerTitle w-1/2 flex flex-col mx-auto justify-center">
        <div class="PageTitle">
            <h1 class="mb-2 text-2xl">User DashBoard</h1>
        </div>
        <div class="UserDetails">
            <div class="helloMsg">
                Welcome {{$userName}}... 
            </div>
            <div class="Details">
                <div class="UserEmail">
                    Your E-Mail ID: {{$userEmail}}
                </div>
                <div class="UserPhone">
                    Your Phone: {{$userNumber}}
                </div>
            </div>
        </div>
    </div>
</div>
<x-error-popup :errors="$errors" :successMessage="session('success')"/>
@endsection
