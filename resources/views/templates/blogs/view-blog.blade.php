@extends('layout.app')

@section('content')
<div class="blogContainer w-full max-w-4xl mx-auto py-8">
    <!-- Meta Info -->
    <div class="flex items-center gap-3 mb-6 text-sm text-slate-555 dark:text-slate-400">
        <div class="flex items-center gap-1 bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 px-3 py-1.5 rounded-full text-slate-700 dark:text-slate-300">
            <i class="fa-solid fa-user text-indigo-550 dark:text-indigo-400"></i>
            <span class="font-bold">{{$blog->user->name}}</span>
        </div>
        <span>&bull;</span>
        <span class="flex items-center gap-1 text-slate-400 dark:text-slate-500"><i class="fa-solid fa-calendar-days"></i> {{$blog->created_at->format('j M, Y h:i A');}}</span>
    </div>

    <!-- Article Header -->
    <h1 class="BlogTitle text-3xl sm:text-4xl font-extrabold text-slate-850 dark:text-slate-100 leading-tight mb-8">
        {{$blog->title}}
    </h1>

    <!-- Image Banner -->
    <div class="blogImage w-full h-[320px] sm:h-[450px] rounded-3xl overflow-hidden bg-slate-200 dark:bg-slate-950 border border-slate-200 dark:border-slate-850 mb-10 shadow-sm dark:shadow-2xl">
        <img class="w-full h-full object-cover" 
             src="{{ $blog->thumbnail ? (str_starts_with($blog->thumbnail, 'http') ? $blog->thumbnail : asset('/storage/'.$blog->thumbnail)) : asset('/images/thumbnail-placeholder.jpg') }}" 
             alt="Blog banner image">
    </div>

    <!-- Article Content -->
    <div class="blogDescription prose dark:prose-invert prose-indigo max-w-none text-slate-700 dark:text-slate-300 leading-relaxed text-base mb-12 font-sans space-y-6">
        {!! $blog->description !!}
    </div>

    <hr class="border-slate-200 dark:border-slate-850 mb-10">

    <!-- Comment Section -->
    <div class="commentSection space-y-8">
        <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 flex items-center gap-2">
            <i class="fa-solid fa-comments text-indigo-550 dark:text-indigo-400"></i> Comments
        </h3>
        
        <div class="userComments space-y-4">
            @if ($comments->isNotEmpty())
                @foreach($comments as $comment)
                <div class="comment flex gap-4 p-4 rounded-2xl bg-slate-100/50 dark:bg-slate-900/30 border border-slate-200 dark:border-slate-850">
                    <div class="userImage flex-shrink-0">
                        <img src="{{$comment->user->google_id ? $comment->user->avatar : asset('/images/person.png')}}" alt="User avatar" class="h-10 w-10 rounded-full border border-slate-300 dark:border-slate-700 bg-slate-200 dark:bg-slate-800 object-cover">
                    </div>
                    <div class="commentContent flex-grow space-y-1"> 
                        <div class="userName text-sm font-bold text-slate-700 dark:text-slate-200">{{$comment->user->name}}</div>
                        <div class="userComment text-sm text-slate-600 dark:text-slate-400 leading-relaxed font-sans">{{$comment->comment}}</div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="noComments py-8 text-center bg-slate-100/20 dark:bg-slate-900/20 rounded-2xl border border-slate-200 dark:border-slate-850 border-dashed text-slate-450 dark:text-slate-500 text-sm font-sans">
                    No comments yet. Start the conversation below!
                </div>
            @endif
        </div>

        <!-- Add Comment Form -->
        <div class="AddCommentForm mt-6 p-6 rounded-2xl bg-white dark:bg-slate-900/40 border border-slate-200 dark:border-slate-850 space-y-4 shadow-sm">
            <h4 class="text-sm font-bold text-slate-700 dark:text-slate-200">Share your thoughts</h4>
            <form action="{{ route('viewBlog.comment.add', $blog->id) }}" method="POST" class="space-y-4">
                @csrf
                <div class="relative">
                    <textarea name="usercomment" id="usercomment" rows="3" max="250" required
                              placeholder="Write a comment..."
                              class="w-full px-4 py-3 rounded-xl bg-slate-100/60 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-850 text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-sm font-sans resize-none"></textarea>
                </div>
                <button type="submit" class="px-6 py-2.5 bg-indigo-650 hover:bg-indigo-600 border border-indigo-550/20 text-white text-sm font-bold rounded-xl transition-all">
                    Post Comment
                </button>
            </form>
        </div>
    </div>
</div>
@endsection