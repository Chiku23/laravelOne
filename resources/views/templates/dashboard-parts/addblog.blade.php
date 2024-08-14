@extends('templates/dashboard')

@section('dashboard-content')
<div class="AddBlogMain sm:w-1/2">
    <h2 class="text-xl font-bold mb-4">Add a Blog</h2>
    <p class="my-2">Publish a new blog by filling out this form:</p>
    <!-- Form to update account Details-->
    <form action="{{ route('publishBlog') }}" method="post" class="mt-2">
        @csrf
        <div class="formContent flex flex-col">
            <label for="title" class="font-bold my-2">Blog Title:</label>
            <input type="text" name="title" value="{{ old('title') }}" class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300">

            <label for="description" class="font-bold my-2">Description:</label>
            <textarea name="description" rows="5" class="rounded bg-transparent active:outline:none border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-300">{{ old('description') }}</textarea>

            <div class="Actions mt-3 flex">
                <button type="submit" class="bg-green-500 px-5 py-2 rounded font-bold">Publish</button>
            </div>
        </div>
    </form>
</div>
@endsection
