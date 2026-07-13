@extends('layout.app')

@section('content')
@php
    // Get the user Data in the array
    $arrUser = $user->toArray(); 
    $userName = $arrUser['name'];
    $userEmail = $arrUser['email'];
@endphp
<div class="DashboardMain w-full py-6">
    <div class="flex flex-col md:flex-row gap-8 w-full items-start">
        <!-- Dashboard Sidebar Navigation -->
        <aside class="leftSidebar w-full md:w-1/4 bg-white dark:bg-slate-900/40 backdrop-blur-md border border-slate-200 dark:border-slate-850 p-5 rounded-2xl space-y-6 shadow-sm">
            <!-- Mini Profile -->
            <div class="profileInfo pb-4 border-b border-slate-200 dark:border-slate-800/80 flex items-center gap-3">
                <div class="h-10 w-10 rounded-full overflow-hidden border border-slate-300 dark:border-slate-700 bg-slate-200 dark:bg-slate-800">
                    <img src="{{ $arrUser['avatar'] ?? asset('images/person.png') }}" alt="Avatar" class="object-cover h-full w-full">
                </div>
                <div class="truncate">
                    <h3 class="text-sm font-bold text-slate-800 dark:text-slate-100 truncate">{{$userName}}</h3>
                    <p class="text-xs text-slate-450 dark:text-slate-500 truncate">{{$userEmail}}</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="ActionGroup">
                <div class="Actions flex flex-col gap-2 font-medium">
                    <a href="{{route('dashboard')}}">
                        <div class="px-4 py-3 rounded-xl transition-all flex items-center gap-3 text-sm hover:bg-slate-50 dark:hover:bg-slate-800/60 {{Request::routeIs('dashboard') ? 'bg-indigo-50 dark:bg-indigo-650/15 border-l-4 border-indigo-550 dark:border-indigo-500 text-indigo-650 dark:text-indigo-300 font-bold' : 'text-slate-500 dark:text-slate-400 border-l-4 border-transparent hover:text-slate-700 dark:hover:text-slate-200'}}">
                            <i class="fa-solid fa-blog text-base w-5"></i> My Blogs
                        </div>
                    </a>
                    <a href="{{route('addblog')}}">
                        <div class="px-4 py-3 rounded-xl transition-all flex items-center gap-3 text-sm hover:bg-slate-50 dark:hover:bg-slate-800/60 {{Request::routeIs('addblog') ? 'bg-indigo-50 dark:bg-indigo-650/15 border-l-4 border-indigo-550 dark:border-indigo-500 text-indigo-650 dark:text-indigo-300 font-bold' : 'text-slate-500 dark:text-slate-400 border-l-4 border-transparent hover:text-slate-700 dark:hover:text-slate-200'}}">
                            <i class="fa-solid fa-file-circle-plus text-base w-5"></i> Add a Blog
                        </div>
                    </a>
                    <a href="{{route('accountsetting')}}">
                        <div class="px-4 py-3 rounded-xl transition-all flex items-center gap-3 text-sm hover:bg-slate-50 dark:hover:bg-slate-800/60 {{Request::routeIs('accountsetting') ? 'bg-indigo-50 dark:bg-indigo-650/15 border-l-4 border-indigo-550 dark:border-indigo-500 text-indigo-650 dark:text-indigo-300 font-bold' : 'text-slate-500 dark:text-slate-400 border-l-4 border-transparent hover:text-slate-700 dark:hover:text-slate-200'}}">
                            <i class="fa-solid fa-screwdriver-wrench text-base w-5"></i> Account Settings
                        </div>
                    </a>
                    <a href="{{route('updatepassword')}}">
                        <div class="px-4 py-3 rounded-xl transition-all flex items-center gap-3 text-sm hover:bg-slate-50 dark:hover:bg-slate-800/60 {{Request::routeIs('updatepassword') ? 'bg-indigo-50 dark:bg-indigo-650/15 border-l-4 border-indigo-550 dark:border-indigo-500 text-indigo-650 dark:text-indigo-300 font-bold' : 'text-slate-500 dark:text-slate-400 border-l-4 border-transparent hover:text-slate-700 dark:hover:text-slate-200'}}">
                            <i class="fa-solid fa-key text-base w-5"></i> Update Password
                        </div>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Panel Content -->
        <main class="RightMain w-full md:w-3/4 bg-white dark:bg-slate-900/20 backdrop-blur-sm border border-slate-200 dark:border-slate-850 p-6 sm:p-8 rounded-2xl shadow-sm">
            <div class="userWelCome pb-4 mb-6 border-b border-slate-200 dark:border-slate-850 text-slate-500 dark:text-slate-350">
                Welcome back, <strong class="text-slate-800 dark:text-slate-100 font-bold">{{$userName}}</strong>!
            </div>
            <div class="DashboardContent">
                @yield('dashboard-content')
            </div> 
        </main>
    </div>
</div>
@endsection
