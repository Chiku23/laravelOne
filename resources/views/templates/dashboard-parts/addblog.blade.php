@extends('templates/dashboard')

@section('dashboard-content')
<style>
    .ql-picker-label,
    .ql-snow .ql-stroke{
        color: #FFFFFF !important;
        stroke: #FFFFFF;
    }
</style>
@php
    $editblog = [];
    if(isset($blog)){
        $editblog = $blog->toArray() ?? [];
    }
@endphp
<div class="AddBlogMain">
    <h2 class=" font-bold mb-4 text-2xl border-b border-slate-400 pb-2">{{isset($editblog['id']) ? 'Update' : 'Add' }} a Blog</h2>
    <p class="my-2">{{isset($editblog['id']) ? 'Update the blog by updatig this below form' : 'Publish a new blog by filling out this form:' }}</p>
    <!-- Form to update account Details-->
    <form action="{{ route('publishBlog') }}" method="post" class="mt-2">
        @csrf
        <input type="hidden" name="editblogid" value="{{$editblog['id'] ?? ''}}">
        <div class="formContent flex flex-col">
            <label for="title" class="font-bold my-2">Blog Title:</label>
            <input type="text" id="title" name="title" value="{{ $editblog['title'] ?? '' }}" class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300">

            <label for="description" class="font-bold my-2">Description:</label>
            <div name="description" id="editor" rows="8" class="!h-48 rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300 text-white"></div>
            <input type="hidden" name="content" id="hidden-content">
            <div class="Actions mt-3 flex">
                <button type="submit" class="bg-green-500 px-5 py-2 rounded font-bold">{{isset($editblog['id']) ? 'Update' : 'Publish' }}</button>
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
</script>

@endsection
