@extends('layout.app')

@section('content')
<div class="IndexMain w-full font-mono">
    <div class="IndexTop">
        {{-- Will Add Something --}}
    </div>
    <div class="indexContent flex flex-col md:flex-row">
        <div class="leftCol md:w-3/4 pt-4 m-2">
            <div class="authorFilter p-4 bg-gray-800">
                <form action="{{ route('home') }}" method="GET" id="authorFilterForm">
                    <input type="text" name="author" placeholder="Enter an author's name" 
                           class="bg-transparent text-white border-2 w-full sm:w-[350px]"
                           value="{{ request()->get('author') }}">
                    <button type="submit" class="border-2 border-white bg-transparent hover:bg-indigo-950 px-4 py-2 rounded font-bold mt-2 md:mt-0">Filter</button>
                </form>
            </div>
           <div class="blogsContainer">
               @if(!empty($blogs->isNotEmpty()))
                    @foreach($blogs as $blog)
                        <div class="blogs flex my-4 p-4 bg-gray-800 rounded shadow-lg">
                            <div class="contentBox">
                                <div class="BlogAuthor font-mono text-slate-400 mb-2">
                                    Author: {{ $blog->user->name }} | Published on: {{$blog->created_at->format('j/F/Y');}}
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
                @else
                    <div class="noBlogs flex my-4 p-4 bg-gray-800 rounded shadow-lg">
                        No Blogs Found.
                    </div>
                @endif
                
           </div>
        </div>
        <div class="rightCol md:w-1/4 text-right m-2">
            
        </div>
    </div>
</div>
@endsection