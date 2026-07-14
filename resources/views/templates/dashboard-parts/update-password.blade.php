@extends('templates/dashboard')

@section('dashboard-content')
@php
    // Get the user Data in the array
    $arrUser = $user->toArray(); 
    $userName = $arrUser['name'];
@endphp
<div class="accountSettingMain max-w-xl bg-white dark:bg-slate-900/40 border border-[#ccd0d4] dark:border-slate-800 p-6 sm:p-8 rounded shadow-sm">
    <h2 class="font-bold mb-4 text-lg border-b border-slate-200 dark:border-slate-850 pb-3 text-slate-800 dark:text-slate-100">Update Password</h2>
    <p class="text-xs text-slate-550 dark:text-slate-400 mb-6 font-sans">Keep your account secure by updating your password periodically:</p>
    
    <!-- Form to update account Details-->
    <form action="{{ route('updateUserPassword') }}" method="post" class="space-y-4">
        @csrf
        <div class="formContent flex flex-col space-y-4">
            <div class="space-y-1">
                <label for="password" class="block text-xs font-semibold text-slate-600 dark:text-slate-300">Current Password</label>
                <input type="password" id="password" name="password" required class="w-full px-3 py-1.5 bg-slate-100/60 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-xs font-sans rounded">
            </div>
            
            <div class="space-y-1">
                <label for="newpassword" class="block text-xs font-semibold text-slate-600 dark:text-slate-300">New Password</label>
                <input type="password" id="newpassword" name="newpassword" required class="w-full px-3 py-1.5 bg-slate-100/60 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-xs font-sans rounded">
            </div>
            
            <div class="space-y-1">
                <label for="newpassword_confirmation" class="block text-xs font-semibold text-slate-600 dark:text-slate-300">Confirm New Password</label>
                <input type="password" id="newpassword_confirmation" name="newpassword_confirmation" required class="w-full px-3 py-1.5 bg-slate-100/60 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-xs font-sans rounded">
            </div>

            <div class="Actions pt-4">
                <button type="submit" class="px-4 py-2 bg-[#2271b1] hover:bg-[#135e96] border border-slate-300/10 text-white text-xs font-bold rounded transition-all">
                    Update Password
                </button>
            </div>
        </div>
    </form>
</div>
@endsection