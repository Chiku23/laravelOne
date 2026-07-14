@extends('layout.app')

@section('content')
@php
    // Get the user Data in the array
    $arrUser = $user->toArray(); 
    $userName = $arrUser['name'];
    $userEmail = $arrUser['email'];
@endphp
<div class="flex flex-col h-screen w-full overflow-hidden font-sans bg-[#f0f2f5] dark:bg-[#0c0d10]">
    <!-- WordPress Style Admin Bar (Top Bar) -->
    <header class="h-9 w-full bg-[#1d2327] dark:bg-[#0c0d0f] flex items-center justify-between px-3 text-[#c3c4c7] text-xs select-none border-b border-slate-800/40 z-50 flex-shrink-0">
        <!-- Left Side: Brand & Quick links -->
        <div class="flex items-center gap-4">
            <!-- Mobile Toggle Button -->
            <button id="wpMobileSidebarToggle" class="md:hidden p-1 text-slate-400 hover:text-white transition-colors">
                <i class="fa-solid fa-bars text-sm"></i>
            </button>
            <a href="{{ route('home') }}" class="flex items-center gap-1.5 hover:bg-[#2c3338] hover:text-[#72aee6] py-2 px-2 -my-2 transition-all font-semibold text-slate-300">
                <i class="fa-solid fa-house"></i>
                <span>Thought Threads</span>
            </a>
        </div>
        
        <!-- Right Side: User Controls -->
        <div class="flex items-center gap-2">
            <div class="flex items-center gap-1.5 py-2 px-2 select-none">
                <span>Howdy, <strong class="text-white">{{ $userName }}</strong></span>
                <div class="h-5 w-5 rounded-full overflow-hidden border border-slate-600 bg-slate-200">
                    <img src="{{ $arrUser['avatar'] ?? asset('images/person.png') }}" alt="Avatar" class="object-cover h-full w-full">
                </div>
            </div>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-1 hover:bg-[#2c3338] hover:text-red-400 py-2 px-2 -my-2 transition-all font-semibold text-red-300">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="hidden sm:inline">Log Out</span>
            </a>

        </div>
    </header>

    <!-- Main Admin Container -->
    <div class="flex flex-row flex-grow w-full overflow-hidden relative">
        <!-- WordPress Left Sidebar -->
        <aside id="wpSidebar" class="fixed md:static inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out w-52 bg-[#1d2327] dark:bg-[#0c0d0f] text-[#c3c4c7] flex flex-col z-40 flex-shrink-0 border-r border-slate-800/40 pt-9 md:pt-0">
            <!-- Navigation Links -->
            <nav class="ActionGroup py-3 flex-grow overflow-y-auto">
                <div class="Actions flex flex-col font-medium text-[13px]">
                    <a href="{{route('dashboard')}}">
                        <div class="px-4 py-2.5 transition-all flex items-center gap-3 {{Request::routeIs('dashboard') ? 'bg-[#2271b1] text-white border-l-[4px] border-[#72aee6] font-bold' : 'hover:bg-[#2c3338] hover:text-[#72aee6] border-l-[4px] border-transparent'}}">
                            <i class="fa-solid fa-gauge text-sm w-4 text-center text-slate-400"></i> Dashboard
                        </div>
                    </a>
                    <a href="{{route('media')}}">
                        <div class="px-4 py-2.5 transition-all flex items-center gap-3 {{Request::routeIs('media') ? 'bg-[#2271b1] text-white border-l-[4px] border-[#72aee6] font-bold' : 'hover:bg-[#2c3338] hover:text-[#72aee6] border-l-[4px] border-transparent'}}">
                            <i class="fa-solid fa-images text-sm w-4 text-center text-slate-400"></i> Media Library
                        </div>
                    </a>
                    <a href="{{route('addblog')}}">
                        <div class="px-4 py-2.5 transition-all flex items-center gap-3 {{Request::routeIs('addblog') ? 'bg-[#2271b1] text-white border-l-[4px] border-[#72aee6] font-bold' : 'hover:bg-[#2c3338] hover:text-[#72aee6] border-l-[4px] border-transparent'}}">
                            <i class="fa-solid fa-pen-to-square text-sm w-4 text-center text-slate-400"></i> Add Blog
                        </div>
                    </a>
                    <a href="{{route('accountsetting')}}">
                        <div class="px-4 py-2.5 transition-all flex items-center gap-3 {{Request::routeIs('accountsetting') ? 'bg-[#2271b1] text-white border-l-[4px] border-[#72aee6] font-bold' : 'hover:bg-[#2c3338] hover:text-[#72aee6] border-l-[4px] border-transparent'}}">
                            <i class="fa-solid fa-user text-sm w-4 text-center text-slate-400"></i> Account Settings
                        </div>
                    </a>
                    <a href="{{route('updatepassword')}}">
                        <div class="px-4 py-2.5 transition-all flex items-center gap-3 {{Request::routeIs('updatepassword') ? 'bg-[#2271b1] text-white border-l-[4px] border-[#72aee6] font-bold' : 'hover:bg-[#2c3338] hover:text-[#72aee6] border-l-[4px] border-transparent'}}">
                            <i class="fa-solid fa-key text-sm w-4 text-center text-slate-400"></i> Update Password
                        </div>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Panel Content Area -->
        <main class="flex-grow overflow-y-auto bg-[#121316] p-6 md:p-8 flex flex-col">
            <div class="w-full max-w-4xl mx-auto flex-grow">
                <div class="DashboardContent">
                    @yield('dashboard-content')
                </div> 
            </div>
        </main>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('wpMobileSidebarToggle');
    const sidebar = document.getElementById('wpSidebar');
    
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebar.classList.toggle('-translate-x-full');
        });
        
        document.addEventListener('click', function(e) {
            if (!sidebar.contains(e.target) && e.target !== toggleBtn) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    }
});
</script>
@endsection
