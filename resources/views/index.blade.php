@extends('layout.app')

@section('content')
<div class="IndexMain">
    <div class="Notice text-center">
        This section is for Notices
    </div>
    <div class="indexContent flex">
        <div class="leftCol w-3/4">
           <div class="blogsContainer">
                <div class="ContainerTitle">Blogs</div>
                <div class="blogs flex">
                    <div class="imgBox h-32 w-32 border flex-shrink-0">
                        <img src="https://placehold.co/600x400" alt="ImageTitle" class="w-full h-full object-cover">
                    </div>
                    <div class="contentBox border flex-grow">
                        <div class="BlogTitle">Blog Title</div>
                        <div class="BlogDescription">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim aperiam ipsa veritatis iusto? Modi asperiores voluptatum saepe harum officiis, rem doloribus. Similique, nostrum! Sunt possimus sint illum, aut quisquam rerum.</div>
                    </div>
                </div>
           </div>
        </div>
        <div class="rightCol w-1/4">
            Sidebar
        </div>
    </div>
</div>
@endsection