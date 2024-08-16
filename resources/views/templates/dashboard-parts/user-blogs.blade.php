@extends('templates/dashboard')

@section('dashboard-content')
@if(!empty($blogs))
<div class="BlogsPageTitle font-bold mb-4 text-2xl border-b border-slate-400 pb-2">Pubished Blogs</div>
    @foreach($blogs as $blog)
        <div class="blogs flex my-4 p-4 bg-gray-800 rounded shadow-lg">
            <div class="contentBox">
                <div class="BlogPublishTime font-mono text-slate-400 mb-2">
                   Publish Time: {{$blog->created_at->format('j/F/Y');}}
                </div>
                <div class="BlogTitle mb-2 pb-2 text-2xl border-b border-slate-500 font-bold text-slate-200 font-mono">
                    {{$blog->title}}
                </div>
                <div class="BlogDescription font-mono text-slate-300">
                    {{$blog->description}}
                </div>
            </div>
        </div>
    @endforeach
@endif
@endsection