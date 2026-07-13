@extends('layout.app')

@section('content')
<div class="ContactMain w-full max-w-3xl mx-auto py-8">
    <div class="bg-white dark:bg-slate-900/40 backdrop-blur-md border border-slate-200 dark:border-slate-850 p-8 rounded-3xl space-y-6 shadow-sm">
        <div class="border-b border-slate-200 dark:border-slate-800/80 pb-4 text-center">
            <h1 class="text-3xl font-extrabold text-slate-850 dark:text-slate-100">Contact Us</h1>
        </div>
        <div class="text-center space-y-6 py-4 font-sans">
            <p class="text-slate-550 dark:text-slate-400">Have questions, feedback, or need support? Reach out to us!</p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-950/50 border border-slate-200 dark:border-slate-850 space-y-1">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Email Address</span>
                    <p class="text-sm font-semibold text-indigo-650 dark:text-indigo-400"><a href="mailto:support@thoughtthreads.com">support@thoughtthreads.com</a></p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-950/50 border border-slate-200 dark:border-slate-850 space-y-1">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Office Address</span>
                    <p class="text-sm text-slate-650 dark:text-slate-350">123 Innovation Way, Tech Suite 404, Silicon Valley, CA</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
