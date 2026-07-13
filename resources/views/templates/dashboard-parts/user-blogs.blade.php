@extends('templates/dashboard')

@section('dashboard-content')
<!-- Admin Statistics Overview Widgets -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <div class="bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-850 p-5 rounded-2xl flex items-center gap-4 shadow-sm">
        <div class="h-12 w-12 rounded-xl bg-indigo-550/10 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-xl flex-shrink-0">
            <i class="fa-solid fa-file-invoice"></i>
        </div>
        <div>
            <span class="text-xs text-slate-400 dark:text-slate-500 font-bold uppercase tracking-wider">Total Posts</span>
            <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mt-0.5">{{ $totalBlogs ?? 0 }}</h3>
        </div>
    </div>
    <div class="bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-850 p-5 rounded-2xl flex items-center gap-4 shadow-sm">
        <div class="h-12 w-12 rounded-xl bg-emerald-550/10 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-xl flex-shrink-0">
            <i class="fa-solid fa-comments"></i>
        </div>
        <div>
            <span class="text-xs text-slate-400 dark:text-slate-500 font-bold uppercase tracking-wider">Comments</span>
            <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mt-0.5">{{ $totalComments ?? 0 }}</h3>
        </div>
    </div>
    <div class="bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-850 p-5 rounded-2xl flex items-center gap-4 shadow-sm">
        <div class="h-12 w-12 rounded-xl bg-amber-550/10 dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400 text-xl flex-shrink-0">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        <div>
            <span class="text-xs text-slate-400 dark:text-slate-500 font-bold uppercase tracking-wider">Account Role</span>
            <h3 class="text-lg font-bold text-slate-700 dark:text-slate-200 mt-0.5">Author</h3>
        </div>
    </div>
</div>

<div class="flex items-center justify-between mb-6 border-b border-slate-200 dark:border-slate-800/80 pb-3">
    <h2 class="font-bold text-xl text-slate-800 dark:text-slate-100">Manage Articles</h2>
    <a href="{{ route('addblog') }}" class="px-4 py-2 bg-indigo-650 hover:bg-indigo-600 border border-indigo-550/20 text-white text-xs font-bold rounded-xl transition-all flex items-center gap-2">
        <i class="fa-solid fa-plus text-xs"></i> New Post
    </a>
</div>

@if(!empty($blogs) && $blogs->isNotEmpty())
    <div class="overflow-x-auto bg-white dark:bg-slate-900/20 border border-slate-200 dark:border-slate-850 rounded-2xl shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-200 dark:border-slate-850 bg-slate-50 dark:bg-slate-900/50 text-slate-500 dark:text-slate-400 font-bold text-xs uppercase tracking-wider">
                    <th class="p-4">Article</th>
                    <th class="p-4 hidden sm:table-cell">Publish Date</th>
                    <th class="p-4 text-center">Status</th>
                    <th class="p-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-slate-850 text-sm">
                @foreach($blogs as $blog)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/10 transition-colors">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg overflow-hidden bg-slate-200 dark:bg-slate-950 border border-slate-200 dark:border-slate-850 flex-shrink-0 hidden xs:block">
                                    <img src="{{($blog->thumbnail) ? asset('/storage/'.$blog->thumbnail) : asset('/images/thumbnail-placeholder.jpg')}}" alt="" class="object-cover w-full h-full">
                                </div>
                                <div class="max-w-[200px] sm:max-w-xs truncate">
                                    <a href="{{ route('viewBlog', $blog->id) }}" class="font-bold text-slate-700 dark:text-slate-200 hover:text-indigo-650 dark:hover:text-indigo-400 transition-colors block truncate">{{ $blog->title }}</a>
                                    <span class="text-xs text-slate-450 dark:text-slate-500 sm:hidden">Published: {{$blog->created_at->format('j M, Y');}}</span>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-slate-500 dark:text-slate-400 hidden sm:table-cell">
                            {{$blog->created_at->format('j M, Y h:i A');}}
                        </td>
                        <td class="p-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/25">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span> Active
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <div class="inline-flex items-center gap-2">
                                <form action="{{ route('blog.edit') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="editblogid" value="{{$blog->id}}">
                                    <button type="submit" title="Edit Post" class="p-2 text-indigo-650 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-200 hover:bg-slate-100 dark:hover:bg-slate-850 rounded-lg transition-all cursor-pointer">
                                        <i class="fa-solid fa-pen-to-square text-base"></i>
                                    </button>
                                </form>
                                <form action="{{ route('blog.delete', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete Post" class="p-2 text-rose-600 dark:text-rose-500 hover:text-rose-500 dark:hover:text-rose-300 hover:bg-rose-100 dark:hover:bg-rose-950/20 rounded-lg transition-all cursor-pointer">
                                        <i class="fa-solid fa-trash-can text-base"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="py-12 text-center bg-slate-900/10 border border-slate-850 border-dashed rounded-2xl text-slate-500">
        <i class="fa-solid fa-file-circle-xmark text-3xl mb-2 text-slate-600"></i>
        <p class="font-bold">No Blogs Found</p>
        <p class="text-sm text-slate-600 mt-1">Click "New Post" to publish your first article!</p>
    </div>
@endif
@endsection