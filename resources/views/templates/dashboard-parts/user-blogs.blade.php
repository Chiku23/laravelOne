@extends('templates/dashboard')

@section('dashboard-content')
@if(!empty($blogs))
<div class="BlogsPageTitle font-bold mb-4 text-2xl border-b border-slate-400 pb-2">Pubished Blogs</div>
    @foreach($blogs as $blog)
        <div class="blogs flex flex-wrap sm:flex-nowrap my-4 p-4 bg-gray-800 rounded shadow-lg relative border border-white">
            <div class="imageBox w-[200px] h-[150px] border-2 m-2">
                <img src="{{($blog->thumbnail) ? asset('/storage/'.$blog->thumbnail) : asset('/images/thumbnail-placeholder.jpg')}}" alt="thumbnail-image" class="object-cover h-full w-full">
            </div>
            <div class="contentBox w-full" id="blog{{$blog->id;}}">
                <div class="BlogPublishTime font-mono text-slate-400 mb-2">
                   Publish Time: {{$blog->created_at->format('j/F/Y');}}
                </div>
                <div class="BlogTitle mb-2 pb-2 text-2xl border-b border-slate-500 font-bold text-slate-200 font-mono">
                    {{$blog->title}}
                </div>
                <div class="BlogDescription font-mono text-slate-300">
                    {!! $blog->description !!}
                </div>
            </div>
            <div class="relative sm:absolute right-0 flex justify-end w-full">
                <!-- Delete Blog Form -->
                <form action="{{ route('blog.delete', $blog->id) }}" method="POST" class="p-2">
                   @csrf
                   @method('DELETE')
                   <button type="submit" title="delete" class="delete delete-blog text-red-500 px-2 sm:px-4 cursor-pointer text-xl">
                       <i class="fa-solid fa-trash"></i>
                   </button>
               </form>
               <form action="{{ route('blog.edit') }}" method="POST" class="p-2">
                   @csrf
                   <input type="hidden" name="editblogid" value="{{$blog->id}}">
                   <button type="submit" title="edit" class="edit edit-blog text-blue-500 px-2 sm:px-4 cursor-pointer text-xl">
                       <i class="fa-solid fa-edit"></i>
                   </button>
               </form>
              </div>
        </div>
    @endforeach
@endif
@endsection