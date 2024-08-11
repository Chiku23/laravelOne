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
    <div class="ContainerTitle flex mx-auto justify-center mx-8">
        <div class="leftSidebar bg-indigo-950 md:min-w-60 p-4 border-r">
            <div class="ActionGroup">
                <div class="Actions flex flex-col">
                    <a href="" class="bg-indigo-800 px-4 py-2 border-l-4">My Blogs</a>
                    <a href="{{route('home')}}" class="bg-indigo-800 px-4 py-2 border-l-4 border-b-1">Account Settings</a>
                </div>
            </div>
        </div>
        <div class="RightMain p-4">
            <div class="Content">
                <div class="WelcomeUser">
                    Hello {{$userName}}.
                </div>
                <br>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, vero nemo illum eum neque inventore tenetur fuga facilis odio dolores. Quod labore mollitia enim consequatur qui, necessitatibus omnis. Vero officiis cum iure molestias aliquam, eaque, incidunt sapiente ex ut earum autem, distinctio iste dolor mollitia consectetur recusandae quisquam. Officia fuga officiis non veritatis distinctio autem labore qui atque delectus, fugit quis exercitationem alias necessitatibus eligendi ipsum assumenda possimus ratione quasi? Quasi excepturi in laborum quo et accusantium consequatur officiis, maiores omnis voluptas ipsa eos quae officia error autem magni, libero assumenda! Cupiditate quidem unde velit quo quibusdam saepe architecto tempora.
            </div>
        </div>
    </div>
</div>
<x-error-popup :errors="$errors" :successMessage="session('success')"/>

@endsection
