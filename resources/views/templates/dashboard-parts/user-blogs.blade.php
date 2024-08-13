@extends('templates/dashboard')

@section('dashboard-content')
@if(!empty($blogs))
    @foreach($blogs as $blog)
        <div class="blogs flex my-4 p-4 bg-gray-800 rounded shadow-lg">
            <div class="contentBox">
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