@extends('layout.app')

@section('content')
@php
    // Get the Customer Data in the array
    $arrCustomer = $customer->toArray(); 
    if(!empty($arrCustomer)){
        $strMainMessage = "User Logged In.";
    }else{
        $strMainMessage = "Not Logged.";
    } 
@endphp


<div class="DashboardMain">
    <div class="ContainerTitle w-1/2 flex mx-auto justify-center">
        <h1 class="mb-2 text-2xl">DashBoard Page</h1>
        {{$strMainMessage}}
    </div>
</div>
@endsection
