@extends('layout.app')

@section('content')
<div class="IndexMain w-full py-6">
    <div class="indexContent flex flex-col md:flex-row gap-8">
        <!-- Main Blog Listing Column -->
        <div class="leftCol md:w-full pt-4">
            <!-- Author filter bar -->
            <div class="authorFilter p-6 bg-white dark:bg-slate-900/40 backdrop-blur-md border border-slate-200 dark:border-slate-850 rounded-2xl mb-8 shadow-sm">
                <form action="{{ route('home') }}" method="GET" id="authorFilterForm" class="flex flex-col sm:flex-row gap-4 items-center">
                    <div class="relative w-full sm:flex-grow">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 dark:text-slate-500">
                            <i class="fa-solid fa-pen-nib"></i>
                        </span>
                        <input type="text" name="author" placeholder="Search by author's name..." 
                               class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-100/60 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-sm"
                               value="{{ request()->get('author') }}">
                    </div>
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-indigo-650 hover:bg-indigo-600 border border-indigo-550/20 text-white rounded-xl font-bold transition-all text-sm">
                        Apply Filter
                    </button>
                    @if(request()->get('author'))
                        <a href="{{ route('home') }}" class="w-full sm:w-auto text-center px-4 py-3 text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-white text-sm font-semibold transition-colors">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <!-- Blogs Container -->
            <div class="blogsContainer space-y-6">
                @if(!empty($blogs->isNotEmpty()))
                    @foreach($blogs as $blog)
                        <article class="blogs flex flex-col sm:flex-row p-6 bg-white dark:bg-slate-900/30 backdrop-blur-sm rounded-2xl border border-slate-200 dark:border-slate-850 hover:border-slate-300 dark:hover:border-slate-800 hover:shadow-indigo-500/5 hover:shadow-xl transition-all duration-300 gap-6">
                            <!-- Thumbnail -->
                            <div class="imageBox w-full sm:w-[30%] min-w-[200px] h-[180px] rounded-xl overflow-hidden bg-slate-200 dark:bg-slate-950 border border-slate-200 dark:border-slate-850">
                                <img src="{{($blog->thumbnail) ? asset('/storage/'.$blog->thumbnail) : asset('/images/thumbnail-placeholder.jpg')}}" alt="thumbnail-image" class="object-cover h-full w-full hover:scale-105 transition-transform duration-500">
                            </div>
                            
                            <!-- Content -->
                            <div class="contentBox flex-grow flex flex-col justify-between py-1">
                                <div>
                                    <!-- Meta -->
                                    <div class="BlogAuthor font-sans text-xs text-slate-500 dark:text-slate-400 mb-2 flex flex-wrap items-center gap-3">
                                        <span class="flex items-center gap-1 bg-slate-100 dark:bg-slate-950/85 px-2.5 py-1 rounded-full border border-slate-200/80 dark:border-slate-850 text-slate-700 dark:text-slate-350"><i class="fa-solid fa-user text-indigo-550 dark:text-indigo-400"></i> {{ $blog->user->name }}</span>
                                        <span class="flex items-center gap-1 text-slate-400 dark:text-slate-500"><i class="fa-solid fa-calendar-days"></i> {{$blog->created_at->format('j M, Y h:i A');}}</span>
                                    </div>
                                    <!-- Title -->
                                    <h2 class="BlogTitle mb-2 text-xl font-bold text-slate-850 dark:text-slate-100 hover:text-indigo-650 dark:hover:text-indigo-400 transition-colors">
                                        <a href="{{ route('viewBlog', $blog->id) }}">{{$blog->title}}</a>
                                    </h2>
                                    <!-- Description -->
                                    <p class="BlogDescription text-sm text-slate-550 dark:text-slate-400 leading-relaxed font-sans line-clamp-3">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 220) }}
                                    </p>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('viewBlog', $blog->id) }}" class="inline-flex items-center text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 gap-1 transition-colors">
                                        Read Article <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @else
                    <div class="noBlogs flex flex-col items-center justify-center p-12 bg-white dark:bg-slate-900/30 border border-slate-200 dark:border-slate-850 rounded-2xl text-slate-400 dark:text-slate-500 text-center">
                        <div class="text-3xl text-slate-300 dark:text-slate-600 mb-3"><i class="fa-solid fa-folder-open"></i></div>
                        <p class="font-bold text-slate-700 dark:text-slate-350">No Blogs Found</p>
                        <p class="text-sm text-slate-500">Try checking back later or adjusting your filter search.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection