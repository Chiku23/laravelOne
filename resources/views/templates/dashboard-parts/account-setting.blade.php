@extends('templates/dashboard')

@section('dashboard-content')
@php
    // Get the user Data in the array
    $arrUser = $user->toArray(); 
    $userName = $arrUser['name'];
    $userEmail = $arrUser['email'];
    $userNumber = $arrUser['number'];
    $userGoogleID = $arrUser['google_id'] ?? '';
@endphp
<div class="accountSettingMain max-w-xl bg-white dark:bg-slate-900/40 border border-[#ccd0d4] dark:border-slate-800 p-6 sm:p-8 rounded shadow-sm">
    <h2 class="font-bold mb-4 text-lg border-b border-slate-200 dark:border-slate-850 pb-3 text-slate-800 dark:text-slate-100">Account Settings</h2>
    <p class="text-xs text-slate-500 dark:text-slate-400 mb-6 font-sans">Update your account information below:</p>
    
    <!-- Form to update account Details-->
    <form action="{{ route('updateUser') }}" method="post" class="space-y-4">
        @csrf
        <div class="formContent flex flex-col space-y-4">
            <div class="space-y-1">
                <label for="name" class="block text-xs font-semibold text-slate-600 dark:text-slate-300">Name</label>
                <input type="text" id="name" name="name" value="{{$userName}}" class="w-full px-3 py-1.5 bg-slate-100/60 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-xs font-sans rounded" required autocomplete="name">
            </div>
            
            <div class="space-y-1">
                <label for="email" class="block text-xs font-semibold text-slate-600 dark:text-slate-300 {{($userGoogleID) ? 'opacity-[0.5]' : '' }}">Email Address</label>
                <input type="email" id="email" name="email" value="{{$userEmail}}" class="w-full px-3 py-1.5 bg-slate-100/60 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-xs font-sans rounded {{($userGoogleID) ? 'opacity-[0.5] bg-slate-200/50 dark:bg-slate-900/25' : '' }}" {{($userGoogleID) ? 'readonly' : '' }} required autocomplete="email">
                @if ($userGoogleID)
                    <p class="text-[10px] text-amber-600 dark:text-amber-500/85 mt-1 font-sans"><i class="fa-solid fa-circle-info"></i> Logged in via Google. Email cannot be modified.</p>
                @endif
            </div>

            <div class="space-y-1">
                <label for="number" class="block text-xs font-semibold text-slate-600 dark:text-slate-300">Phone</label>
                <input type="text" id="number" name="number" value="{{$userNumber}}" class="w-full px-3 py-1.5 bg-slate-100/60 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-xs font-sans rounded" required>
            </div>

            <div class="Actions pt-4">
                <button type="submit" class="px-4 py-2 bg-[#2271b1] hover:bg-[#135e96] border border-slate-300/10 text-white text-xs font-bold rounded transition-all">
                    Update Profile
                </button>
            </div>
        </div>
    </form>
</div>
@endsection