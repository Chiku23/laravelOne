@extends('layout.app')

@section('content')
<div class="IndexMain w-full">
    <div class="Notice text-center">
        This section is for Notices
    </div>
    <div class="indexContent flex">
        <div class="leftCol w-3/4">
           <div class="blogsContainer">
               @if(!empty($blogs))
                    @foreach($blogs as $blog)
                        <div class="blogs flex my-4 p-4 bg-gray-800 rounded shadow-lg">
                            <div class="contentBox">
                                <div class="BlogAuthor font-mono text-slate-400 mb-2">
                                    Author: {{ $blog->user->name }}
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
           </div>
        </div>
        <div class="rightCol w-1/4 text-right">
            
        </div>
    </div>
</div>
@endsection