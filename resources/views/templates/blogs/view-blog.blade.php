@extends('layout.app')

@section('content')

<div class="blogContainer w-full font-mono flex flex-col py-2">
    <div class="BlogTitle capitalize mb-2 pb-2 text-2xl border-b border-slate-500 font-bold text-slate-200 font-mono">{{$blog->title}}</div>
    <div class="blogDescription flex-grow">{!! $blog->description !!}</div>
    <hr>
    <div class="commentSection">
        <div class="sectionTitle text-xl border-b border-slate-500 font-bold text-slate-200 font-mono m-2">
            Comments
        </div>
        <div class="userComments">
            @if ($comments->isNotEmpty())
                @foreach($comments as $comment)
                <div class="comment flex flex-col sm:flex-row p-2">
                    <div class="userImage p-2">
                        <img src="{{$comment->user->google_id ? $comment->user->avatar : asset('/images/person.png')}}" alt="" class="h-8 w-8 rounded-full border-2 border-slate-500">
                    </div>
                    <div class="commentContent p-2"> 
                        <div class="userName text-lg font-bold">{{$comment->user->name}}</div>
                        <div class="userComment">{{$comment->comment}}</div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="noComments p-2">
                    No Comments Found.
                </div>
            @endif
        </div>
    </div>
    {{-- Add Comment Form --}}
    <div class="AddCommentForm">
        <form action="{{ route('viewBlog.comment.add', $blog->id) }}" method="POST" class="flex flex-col p-2 w-full md:w-1/2">
            @csrf
            <input type="text" name="usercomment" id="usercomment" max="250" class="bg-transparent text-white border-2 w-full">
            <button type="submit" class="w-full sm:w-[150px] border-2 border-white bg-transparent hover:bg-indigo-950 px-4 py-2 rounded font-bold mt-2">Comment</button>
        </form>
    </div>
</div>

@endsection