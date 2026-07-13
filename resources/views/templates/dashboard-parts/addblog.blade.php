@extends('templates/dashboard')

@section('dashboard-content')
<style>
    .ql-toolbar.ql-snow {
        background-color: #f8fafc !important;
        border-color: #e2e8f0 !important;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .ql-container.ql-snow {
        border-color: #e2e8f0 !important;
        background-color: #ffffff !important;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
    }
    .ql-editor {
        color: #334155 !important;
    }
    .dark .ql-toolbar.ql-snow {
        background-color: #0f172a !important;
        border-color: #1e293b !important;
    }
    .dark .ql-container.ql-snow {
        border-color: #1e293b !important;
        background-color: #020617 !important;
    }
    .dark .ql-editor {
        color: #e2e8f0 !important;
    }
    .dark .ql-picker-label,
    .dark .ql-snow .ql-stroke {
        color: #e2e8f0 !important;
        stroke: #e2e8f0 !important;
    }
    .dark .ql-snow .ql-fill {
        fill: #e2e8f0 !important;
    }
    .dark .ql-editor.ql-blank::before {
        color: #64748b !important;
    }
</style>
@php
    $editblog = [];
    if(isset($blog)){
        $editblog = $blog->toArray() ?? [];
    }
@endphp
<div class="AddBlogMain max-w-2xl">
    <h2 class="font-bold mb-4 text-2xl border-b border-slate-200 dark:border-slate-800/80 pb-3 text-slate-800 dark:text-slate-100">{{isset($editblog['id']) ? 'Update' : 'Add' }} a Blog</h2>
    <p class="text-sm text-slate-500 dark:text-slate-400 mb-6 font-sans">{{isset($editblog['id']) ? 'Update the blog using the form below:' : 'Publish a new blog post to the community:' }}</p>
    
    <form action="{{ route('publishBlog') }}" method="post" class="space-y-6" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="editblogid" value="{{$editblog['id'] ?? ''}}">
        <div class="formContent flex flex-col space-y-4">
            
            <div class="space-y-1">
                <label for="thumbnailImage" class="block text-sm font-semibold text-slate-650 dark:text-slate-300">Thumbnail Image</label> 
                <input type="file" name="thumbnailImage" id="thumbnailImage" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-650/10 file:text-indigo-600 dark:file:bg-indigo-650/20 dark:file:text-indigo-400 hover:file:bg-indigo-650/30 file:cursor-pointer transition-all">
            </div>
            
            <div class="space-y-1">
                <label for="title" class="block text-sm font-semibold text-slate-650 dark:text-slate-300">Blog Title</label>
                <input type="text" id="title" name="title" value="{{ $editblog['title'] ?? '' }}" class="w-full px-4 py-2.5 rounded-xl bg-slate-100/60 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all text-sm font-sans" placeholder="Enter a catchy title" required>
            </div>
            
            <div class="space-y-1">
                <label class="block text-sm font-semibold text-slate-650 dark:text-slate-300">Description</label>
                <div name="description" id="editor" class="!h-52 rounded text-slate-800 dark:text-slate-100 text-sm font-sans"></div>
                <input type="hidden" name="content" id="hidden-content">
            </div>

            <div class="Actions pt-4">
                <button type="submit" class="px-6 py-3 bg-indigo-650 hover:bg-indigo-600 border border-indigo-550/20 text-white text-sm font-bold rounded-xl transition-all">
                    {{isset($editblog['id']) ? 'Update Post' : 'Publish Post' }}
                </button>
            </div>
        </div>
    </form>
</div>
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        var quill = new Quill('#editor', {
            theme: 'snow',
        });

        document.querySelector('form').onsubmit = function() {
            document.querySelector("#hidden-content").value = quill.root.innerHTML;
        };
        var editContent = @json($editblog['description'] ?? '');
        var QlEditor = document.querySelector('.ql-editor');
        if(editContent !== ''){
            QlEditor.innerHTML = editContent;
        }
    });

    const thumbnailInput = document.getElementById('thumbnailImage');
    let currentPreview = null;

    function handlePreview(src) {
        if (currentPreview) {
            currentPreview.remove();
        }
        currentPreview = document.createElement('div');
        currentPreview.className = 'relative w-full max-w-[280px] h-[160px] rounded-xl overflow-hidden border border-slate-800 bg-slate-950 mt-3';
        currentPreview.innerHTML = `<img src="${src}" class="w-full h-full object-cover" alt="Preview">`;
        thumbnailInput.parentNode.appendChild(currentPreview);
    }

    thumbnailInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handlePreview(URL.createObjectURL(e.target.files[0]));
        }
    });

    @if(isset($editblog['thumbnail']))
        handlePreview("{{ asset('storage/' . $editblog['thumbnail']) }}");
    @endif
</script>

@endsection
