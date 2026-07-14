@extends('templates/dashboard')

@section('dashboard-content')
<div class="mediaLibraryMain w-full bg-white dark:bg-slate-900/40 border border-[#ccd0d4] dark:border-slate-800 p-6 sm:p-8 rounded shadow-sm">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-4 border-b border-slate-200 dark:border-slate-850 pb-3">
        <h2 class="font-bold text-lg text-slate-800 dark:text-slate-100">Media Library</h2>
        <button id="toggleUploadBtn" class="px-3 py-1.5 bg-[#2271b1] hover:bg-[#135e96] border border-slate-300/10 text-white text-xs font-bold rounded transition-all flex items-center gap-2">
            <i class="fa-solid fa-cloud-arrow-up"></i> Add New
        </button>
    </div>

    <!-- Collapsible Upload Area -->
    <div id="uploadSection" class="hidden mb-6 bg-slate-50 dark:bg-slate-950/20 border border-dashed border-slate-350 dark:border-slate-800 p-6 rounded text-center transition-all">
        <form action="{{ route('media.upload') }}" method="post" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="flex flex-col items-center justify-center space-y-2">
                <i class="fa-solid fa-images text-3xl text-slate-400"></i>
                <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">Select files to upload</p>
                <p class="text-xs text-slate-500 dark:text-slate-400">Maximum upload file size: 5 MB. Supported formats: JPEG, PNG, JPG, GIF</p>
            </div>
            
            <div class="flex justify-center">
                <input type="file" name="files[]" id="mediaFiles" multiple accept="image/*" class="hidden" required>
                <button type="button" onclick="document.getElementById('mediaFiles').click()" class="px-3 py-2 bg-slate-200 hover:bg-slate-350 text-slate-800 text-xs font-bold rounded border border-slate-300 transition-all">
                    Select Images
                </button>
            </div>
            <div id="fileNamesList" class="text-xs text-slate-600 dark:text-slate-450 mt-2 font-mono"></div>

            <div class="pt-2 flex justify-center">
                <button type="submit" class="px-4 py-2 bg-[#2271b1] hover:bg-[#135e96] text-white text-xs font-bold rounded transition-all">
                    Start Upload
                </button>
            </div>
        </form>
    </div>

    @if(session('status'))
        <div class="mb-4 p-3 bg-emerald-500/10 text-emerald-650 dark:text-emerald-400 border border-emerald-500/20 rounded text-xs font-semibold flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-6 items-start">
        
        <!-- Images Grid -->
        <div class="flex-1 w-full">
            @if($mediaList->isEmpty())
                <div class="py-12 text-center bg-slate-900/10 dark:bg-slate-950/10 border border-slate-200 dark:border-slate-850 border-dashed rounded text-slate-500">
                    <i class="fa-solid fa-images text-3xl mb-2 text-slate-400"></i>
                    <p class="font-bold text-sm">No media files found</p>
                    <p class="text-xs text-slate-500 mt-1">Click "Add New" to upload your first image.</p>
                </div>
            @else
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                    @foreach($mediaList as $media)
                        <div class="media-thumb-card aspect-square border border-slate-200 dark:border-slate-800 bg-slate-100 dark:bg-slate-950/40 rounded overflow-hidden cursor-pointer hover:border-[#2271b1] transition-all relative group" 
                             onclick="selectMedia({{ json_encode($media) }}, '{{ Storage::url($media->filepath) }}')">
                            <img src="{{ Storage::url($media->filepath) }}" alt="{{ $media->filename }}" class="object-cover w-full h-full">
                            <div class="absolute inset-0 bg-[#2271b1]/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- WordPress style Details Side-Panel -->
        <aside id="mediaDetailsPanel" class="hidden w-full lg:w-72 bg-slate-50 dark:bg-slate-950/20 border border-slate-200 dark:border-slate-850 rounded p-4 flex-shrink-0 flex flex-col space-y-4">
            <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800/80 pb-2">
                <h3 class="font-bold text-xs uppercase text-slate-500 tracking-wider">Attachment Details</h3>
                <button type="button" onclick="closeDetailsPanel()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <!-- Preview image -->
            <div class="w-full h-36 bg-slate-200 dark:bg-slate-950 rounded overflow-hidden border border-slate-300 dark:border-slate-800">
                <img id="detailImg" src="" class="object-contain w-full h-full">
            </div>

            <!-- Meta details list -->
            <div class="text-[11px] text-slate-500 space-y-1.5 border-b border-slate-200 dark:border-slate-800/80 pb-3">
                <div class="truncate"><strong class="text-slate-700 dark:text-slate-300">File name:</strong> <span id="detailName" class="font-mono"></span></div>
                <div><strong class="text-slate-700 dark:text-slate-300">File size:</strong> <span id="detailSize"></span></div>
                <div><strong class="text-slate-700 dark:text-slate-300">Mime type:</strong> <span id="detailMime"></span></div>
                <div><strong class="text-slate-700 dark:text-slate-300">Uploaded:</strong> <span id="detailDate"></span></div>
            </div>

            <!-- Copy URL section -->
            <div class="space-y-1">
                <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider">Copy File URL</label>
                <div class="flex gap-1.5">
                    <input type="text" id="detailUrlInput" readonly class="flex-grow px-2 py-1 border border-slate-200 dark:border-slate-800 text-[10px] font-mono bg-white dark:bg-slate-950 rounded text-slate-800 dark:text-slate-200 focus:outline-none">
                    <button type="button" onclick="copyUrl()" class="px-2 py-1 bg-slate-200 hover:bg-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-[10px] font-bold rounded border border-slate-300 dark:border-slate-700 transition-all flex items-center justify-center w-12" id="copyBtn">
                        Copy
                    </button>
                </div>
            </div>

            <!-- Attachment Relation -->
            <div class="space-y-1">
                <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider">Attached to</label>
                <div id="detailAttachmentList" class="text-xs text-slate-700 dark:text-slate-300 space-y-1">
                    <!-- Dynamic attachment list -->
                </div>
            </div>

            <!-- Delete Form -->
            <div class="pt-3 border-t border-slate-200 dark:border-slate-800/80">
                <form id="deleteMediaForm" action="" method="post" onsubmit="return confirm('Are you sure you want to permanently delete this image from your library? This cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 dark:bg-rose-950/10 dark:hover:bg-rose-950/20 text-xs font-bold rounded border border-rose-200 dark:border-rose-950 transition-all flex items-center justify-center gap-1.5">
                        <i class="fa-solid fa-trash-can"></i> Delete Permanently
                    </button>
                </form>
            </div>
        </aside>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleUploadBtn = document.getElementById('toggleUploadBtn');
        const uploadSection = document.getElementById('uploadSection');
        const mediaFiles = document.getElementById('mediaFiles');
        const fileNamesList = document.getElementById('fileNamesList');

        // Toggle Upload Form
        toggleUploadBtn.addEventListener('click', () => {
            uploadSection.classList.toggle('hidden');
        });

        // Display selected files list
        mediaFiles.addEventListener('change', () => {
            if(mediaFiles.files.length > 0) {
                const list = [];
                for(let i=0; i<mediaFiles.files.length; i++) {
                    list.push(mediaFiles.files[i].name);
                }
                fileNamesList.innerHTML = `<i class="fa-solid fa-file text-[10px]"></i> ` + list.join(', ');
            } else {
                fileNamesList.innerHTML = '';
            }
        });
    });

    let activeMediaId = null;

    function selectMedia(media, storageUrl) {
        // Highlight active card
        document.querySelectorAll('.media-thumb-card').forEach(card => {
            card.classList.remove('border-[#2271b1]', 'ring-1', 'ring-[#2271b1]');
        });
        
        // Find clicked card and style it
        const clickedCard = event.currentTarget;
        clickedCard.classList.add('border-[#2271b1]', 'ring-1', 'ring-[#2271b1]');

        activeMediaId = media.id;
        const panel = document.getElementById('mediaDetailsPanel');
        panel.classList.remove('hidden');

        // Fill panel fields
        document.getElementById('detailImg').src = storageUrl;
        document.getElementById('detailName').textContent = media.filename;
        document.getElementById('detailName').title = media.filename;
        document.getElementById('detailSize').textContent = formatBytes(media.file_size);
        document.getElementById('detailMime').textContent = media.mime_type || 'image';
        document.getElementById('detailDate').textContent = new Date(media.created_at).toLocaleDateString(undefined, {year: 'numeric', month: 'short', day: 'numeric'});

        // Construct absolute URL
        const absoluteUrl = window.location.origin + storageUrl;
        document.getElementById('detailUrlInput').value = absoluteUrl;

        // Reset copy button
        const copyBtn = document.getElementById('copyBtn');
        copyBtn.textContent = 'Copy';
        copyBtn.className = 'px-2 py-1 bg-slate-200 hover:bg-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-[10px] font-bold rounded border border-slate-300 dark:border-slate-700 transition-all flex items-center justify-center w-12';

        // Render attached blogs links
        const attachmentList = document.getElementById('detailAttachmentList');
        attachmentList.innerHTML = '';
        if (media.attached_blogs && media.attached_blogs.length > 0) {
            media.attached_blogs.forEach(blog => {
                const item = document.createElement('div');
                item.className = 'flex items-center justify-between text-[11px] gap-2';
                item.innerHTML = `
                    <span class="font-bold truncate text-slate-650 dark:text-slate-400" title="${blog.title}">${blog.title}</span>
                    <a href="/viewBlog/${blog.id}" target="_blank" class="text-[#2271b1] hover:underline font-semibold flex-shrink-0 flex items-center gap-0.5"><i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i> View</a>
                `;
                attachmentList.appendChild(item);
            });
        } else {
            attachmentList.innerHTML = `<span class="text-slate-400 italic text-[11px]"><i class="fa-solid fa-circle-minus"></i> Unattached</span>`;
        }

        // Set action on delete form
        document.getElementById('deleteMediaForm').action = `/dashboard/media/${media.id}`;
    }

    function closeDetailsPanel() {
        document.getElementById('mediaDetailsPanel').classList.add('hidden');
        document.querySelectorAll('.media-thumb-card').forEach(card => {
            card.classList.remove('border-[#2271b1]', 'ring-1', 'ring-[#2271b1]');
        });
    }

    function copyUrl() {
        const urlInput = document.getElementById('detailUrlInput');
        urlInput.select();
        urlInput.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(urlInput.value);

        const copyBtn = document.getElementById('copyBtn');
        copyBtn.textContent = 'Copied!';
        copyBtn.className = 'px-2 py-1 bg-emerald-500 text-white text-[10px] font-bold rounded transition-all flex items-center justify-center w-12';
    }

    function formatBytes(bytes, decimals = 2) {
        if (!+bytes) return '0 Bytes';
        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`;
    }
</script>
@endsection
