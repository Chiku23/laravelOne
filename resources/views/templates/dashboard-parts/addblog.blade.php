@extends('templates/dashboard')

@section('dashboard-content')
@php
    $editblog = [];
    if(isset($blog)){
        $editblog = $blog->toArray() ?? [];
    }
@endphp

<!-- Block Inserter Sidebar/Panel (WordPress Gutenberg Style) -->
<div id="block-inserter" class="fixed top-0 right-0 z-50 h-full w-80 bg-white dark:bg-slate-900 border-l border-slate-200 dark:border-slate-800/80 shadow-2xl translate-x-full transition-transform duration-300 flex flex-col font-sans">
    <div class="p-4 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between font-sans font-sans">
        <h3 class="font-bold text-sm text-slate-800 dark:text-slate-100 flex items-center gap-2">
            <i class="fa-solid fa-square-plus text-indigo-600 dark:text-indigo-400"></i> Add Block
        </h3>
        <button type="button" onclick="toggleInserter()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-sm">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    
    <!-- Search Block Library -->
    <div class="p-3 border-b border-slate-100 dark:border-slate-800/60 font-sans">
        <div class="relative">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-xs text-slate-400"></i>
            <input type="text" id="block-search" oninput="filterBlocks()" placeholder="Search blocks..." class="w-full pl-8 pr-3 py-1.5 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-xs rounded text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 caret-[#2271b1] dark:caret-indigo-400">
        </div>
    </div>
    
    <!-- Block list -->
    <div class="flex-grow overflow-y-auto p-4 space-y-4 font-sans bg-white dark:bg-slate-900">
        <!-- Text Category -->
        <div class="space-y-2 block-category" data-cat="text">
            <span class="text-[10px] uppercase font-bold text-slate-450 dark:text-slate-500 tracking-wider">Text Blocks</span>
            <div class="grid grid-cols-2 gap-2">
                <button type="button" onclick="insertSelectedBlock('paragraph')" class="block-card p-3 border border-slate-200 dark:border-slate-800/80 hover:border-[#2271b1] dark:hover:border-indigo-500 rounded bg-slate-50/50 dark:bg-slate-950/20 text-center transition-all flex flex-col items-center justify-center gap-1.5 cursor-pointer text-slate-700 dark:text-slate-350">
                    <i class="fa-solid fa-paragraph text-lg text-slate-500 dark:text-slate-400"></i>
                    <span class="text-[11px] font-semibold">Paragraph</span>
                </button>
                <button type="button" onclick="insertSelectedBlock('heading')" class="block-card p-3 border border-slate-200 dark:border-slate-800/80 hover:border-[#2271b1] dark:hover:border-indigo-500 rounded bg-slate-50/50 dark:bg-slate-950/20 text-center transition-all flex flex-col items-center justify-center gap-1.5 cursor-pointer text-slate-700 dark:text-slate-350">
                    <i class="fa-solid fa-heading text-lg text-slate-500 dark:text-slate-400"></i>
                    <span class="text-[11px] font-semibold">Heading</span>
                </button>
                <button type="button" onclick="insertSelectedBlock('quote')" class="block-card p-3 border border-slate-200 dark:border-slate-800/80 hover:border-[#2271b1] dark:hover:border-indigo-500 rounded bg-slate-50/50 dark:bg-slate-950/20 text-center transition-all flex flex-col items-center justify-center gap-1.5 cursor-pointer text-slate-700 dark:text-slate-350">
                    <i class="fa-solid fa-quote-left text-lg text-slate-500 dark:text-slate-400"></i>
                    <span class="text-[11px] font-semibold">Quote</span>
                </button>
                <button type="button" onclick="insertSelectedBlock('list')" class="block-card p-3 border border-slate-200 dark:border-slate-800/80 hover:border-[#2271b1] dark:hover:border-indigo-500 rounded bg-slate-50/50 dark:bg-slate-950/20 text-center transition-all flex flex-col items-center justify-center gap-1.5 cursor-pointer text-slate-700 dark:text-slate-350">
                    <i class="fa-solid fa-list-ul text-lg text-slate-500 dark:text-slate-400"></i>
                    <span class="text-[11px] font-semibold">List</span>
                </button>
            </div>
        </div>

        <!-- Layout Category -->
        <div class="space-y-2 block-category" data-cat="layout">
            <span class="text-[10px] uppercase font-bold text-slate-450 dark:text-slate-500 tracking-wider">Layout Blocks</span>
            <div class="grid grid-cols-1 gap-2">
                <button type="button" onclick="insertSelectedBlock('columns')" class="block-card p-3 border border-slate-200 dark:border-slate-800/80 hover:border-[#2271b1] dark:hover:border-indigo-500 rounded bg-slate-50/50 dark:bg-slate-950/20 text-center transition-all flex flex-col items-center justify-center gap-1.5 cursor-pointer text-slate-700 dark:text-slate-350">
                    <i class="fa-solid fa-columns text-lg text-slate-500 dark:text-slate-400"></i>
                    <span class="text-[11px] font-semibold">Columns Layout Section</span>
                </button>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" onclick="insertSelectedBlock('button')" class="block-card p-3 border border-slate-200 dark:border-slate-800/80 hover:border-[#2271b1] dark:hover:border-indigo-500 rounded bg-slate-50/50 dark:bg-slate-950/20 text-center transition-all flex flex-col items-center justify-center gap-1.5 cursor-pointer text-slate-700 dark:text-slate-300">
                        <i class="fa-solid fa-square-minus text-lg text-slate-500 dark:text-slate-400"></i>
                        <span class="text-[11px] font-semibold">CTA Button</span>
                    </button>
                    <button type="button" onclick="insertSelectedBlock('divider')" class="block-card p-3 border border-slate-200 dark:border-slate-800/80 hover:border-[#2271b1] dark:hover:border-indigo-500 rounded bg-slate-50/50 dark:bg-slate-950/20 text-center transition-all flex flex-col items-center justify-center gap-1.5 cursor-pointer text-slate-700 dark:text-slate-300">
                        <i class="fa-solid fa-grip-lines text-lg text-slate-500 dark:text-slate-400"></i>
                        <span class="text-[11px] font-semibold">Divider Line</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Media Category -->
        <div class="space-y-2 block-category" data-cat="media">
            <span class="text-[10px] uppercase font-bold text-slate-450 dark:text-slate-500 tracking-wider">Media Blocks</span>
            <div class="grid grid-cols-2 gap-2">
                <button type="button" onclick="insertSelectedBlock('image')" class="block-card p-3 border border-slate-200 dark:border-slate-800/80 hover:border-[#2271b1] dark:hover:border-indigo-500 rounded bg-slate-50/50 dark:bg-slate-950/20 text-center transition-all flex flex-col items-center justify-center gap-1.5 cursor-pointer text-slate-700 dark:text-slate-350">
                    <i class="fa-solid fa-image text-lg text-slate-500 dark:text-slate-400"></i>
                    <span class="text-[11px] font-semibold">Image</span>
                </button>
                <button type="button" onclick="insertSelectedBlock('video')" class="block-card p-3 border border-slate-200 dark:border-slate-800/80 hover:border-[#2271b1] dark:hover:border-indigo-500 rounded bg-slate-50/50 dark:bg-slate-950/20 text-center transition-all flex flex-col items-center justify-center gap-1.5 cursor-pointer text-slate-700 dark:text-slate-350">
                    <i class="fa-solid fa-video text-lg text-slate-500 dark:text-slate-400"></i>
                    <span class="text-[11px] font-semibold">Video</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="AddBlogMain max-w-3xl bg-white dark:bg-slate-900/40 border border-[#ccd0d4] dark:border-slate-800 p-6 sm:p-8 rounded shadow-sm font-sans">
    <h2 class="font-bold mb-4 text-lg border-b border-slate-200 dark:border-slate-855 pb-3 text-slate-800 dark:text-slate-100">{{isset($editblog['id']) ? 'Update' : 'Add' }} a Blog</h2>
    <p class="text-xs text-slate-550 dark:text-slate-400 mb-6 font-sans">{{isset($editblog['id']) ? 'Update the blog using the form below:' : 'Publish a new blog post to the community:' }}</p>
    
    @if($errors->any())
        <div class="mb-4 p-3 bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-500/20 rounded text-xs font-semibold font-sans">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('status'))
        <div class="mb-4 p-3 bg-emerald-500/10 text-emerald-600 dark:text-emerald-450 border border-emerald-500/20 rounded text-xs font-semibold font-sans">
            {{ session('status') }}
        </div>
    @endif

    <form id="publish-blog-form" action="{{ route('publishBlog') }}" method="post" class="space-y-6" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="editblogid" value="{{$editblog['id'] ?? ''}}">
        <div class="formContent flex flex-col space-y-5 font-sans">
            
            <div class="space-y-2">
                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300">Thumbnail Image</label>
                <!-- Tab switcher -->
                <div class="flex items-center gap-1.5">
                    <button type="button" id="thumb-tab-upload" onclick="switchThumbTab('upload')" class="thumb-tab active"><i class="fa-solid fa-upload text-[9px] mr-1"></i>Upload File</button>
                    <button type="button" id="thumb-tab-url" onclick="switchThumbTab('url')" class="thumb-tab"><i class="fa-solid fa-link text-[9px] mr-1"></i>Image URL</button>
                </div>
                <!-- Upload pane -->
                <div id="thumb-pane-upload">
                    <div class="flex items-center gap-3">
                        <input type="file" name="thumbnailImage" id="thumbnailImage" accept="image/*" class="hidden">
                        <button type="button" onclick="document.getElementById('thumbnailImage').click()" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 text-xs font-bold rounded cursor-pointer transition-all">
                            Choose File
                        </button>
                        <span id="thumbnailFileName" class="text-xs text-slate-550 dark:text-slate-400">No file chosen</span>
                    </div>
                </div>
                <!-- URL pane -->
                <div id="thumb-pane-url" class="hidden">
                    <input type="text" name="thumbnailUrl" id="thumbnailUrl" placeholder="https://example.com/image.jpg" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 focus:bg-white dark:focus:bg-slate-950 transition-all text-sm rounded caret-[#2271b1] dark:caret-indigo-400 placeholder-slate-400 dark:placeholder-slate-500" oninput="handleThumbUrlPreview(this.value)">
                </div>
            </div>
            
            <div class="space-y-1.5">
                <label for="title" class="block text-xs font-semibold text-slate-655 dark:text-slate-300">Blog Title</label>
                <input type="text" id="title" name="title" value="{{ $editblog['title'] ?? '' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 focus:bg-white dark:focus:bg-slate-950 transition-all text-sm font-sans rounded caret-[#2271b1] dark:caret-indigo-400 placeholder-slate-400 dark:placeholder-slate-500" placeholder="Enter a catchy title" required>
            </div>
            
            <!-- WordPress style Block Editor Canvas -->
            <div class="space-y-2 relative font-sans">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-semibold text-slate-655 dark:text-slate-300">Article Content Blocks</label>
                    <button type="button" onclick="toggleInserter(null)" class="text-[10px] bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 px-2.5 py-1 rounded border border-slate-200 dark:border-slate-700 font-bold transition-all flex items-center gap-1 cursor-pointer">
                        <i class="fa-solid fa-plus text-[9px]"></i> Add Block
                    </button>
                </div>
                
                <!-- Blocks container -->
                <div id="blocks-container" class="min-h-[22rem] p-5 bg-slate-50/50 dark:bg-slate-950/20 border border-slate-200 dark:border-slate-800 rounded relative">
                    <!-- Blocks injected dynamically -->
                    <div id="blocks-empty-hint">
                        <i class="fa-regular fa-file-lines text-4xl opacity-40"></i>
                        <p class="text-xs font-medium">No blocks yet — click <strong>Add Block</strong> to get started</p>
                    </div>
                </div>
                
                <!-- Floating Inserter at bottom -->
                <div class="flex justify-center pt-2">
                    <button type="button" onclick="toggleInserter(null)" class="h-8 w-8 rounded-full bg-[#2271b1] hover:bg-[#135e96] text-white flex items-center justify-center shadow transition-all transform hover:scale-105 cursor-pointer" title="Insert a Block">
                        <i class="fa-solid fa-plus text-sm"></i>
                    </button>
                </div>
                
                <input type="hidden" name="content" id="hidden-content">
            </div>

            <div class="Actions pt-4">
                <button type="submit" class="px-5 py-2 bg-[#2271b1] hover:bg-[#135e96] border border-slate-300/10 text-white text-xs font-bold rounded transition-all cursor-pointer">
                    {{isset($editblog['id']) ? 'Update Blog' : 'Publish Blog' }}
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Styling block elements inside Gutenberg Canvas -->
<style>
    .block-item {
        position: relative;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
        /* No forced padding-bottom — spacer overlay uses position:absolute */
    }
    .block-item:hover {
        box-shadow: 0 4px 12px rgba(34, 113, 177, 0.08);
        border-color: rgba(34, 113, 177, 0.4);
    }
    .block-item:hover .block-spacer-inserter-wrapper {
        opacity: 1;
    }
    .block-item.active-focus {
        border-color: #2271b1 !important;
        box-shadow: 0 4px 14px rgba(34, 113, 177, 0.15);
    }
    /* Inline Add Block inserter — sits at bottom edge of block, half overlapping next */
    .block-spacer-inserter-wrapper {
        position: absolute;
        left: 0;
        right: 0;
        bottom: -10px;
        height: 20px;
        z-index: 30;
        opacity: 0;
        transition: opacity 0.15s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .block-spacer-inserter-wrapper .inserter-line {
        position: absolute;
        left: 0; right: 0;
        height: 1px;
        background: #2271b1;
        pointer-events: none;
    }
    /* Settings panel: use display:grid toggle via JS — NOT Tailwind hidden */
    .block-settings-panel {
        display: none;
        background: rgba(248,250,252,0.85);
        border: 1px solid #e2e8f0;
        padding: 10px;
        border-radius: 6px;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        font-size: 11px;
        color: #374151;
        margin-bottom: 4px;
    }
    .block-settings-panel.open {
        display: grid;
    }
    .dark .block-settings-panel {
        background: rgba(15,23,42,0.6);
        border-color: rgba(51,65,85,0.8);
        color: #cbd5e1;
    }
    /* Style option inputs/selects focus styles */
    .block-settings-panel input[type="text"]:focus,
    .block-settings-panel select:focus {
        outline: none;
        border-color: #2271b1 !important;
        box-shadow: 0 0 0 1px #2271b1;
    }
    .dark .block-settings-panel input[type="text"]:focus,
    .dark .block-settings-panel select:focus {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 1px #6366f1;
    }
    /* Block settings inputs uniform styling */
    .block-settings-panel input[type="text"],
    .block-settings-panel select {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        color: #1e293b;
        font-size: 11px;
        padding: 3px 6px;
        width: 100%;
        transition: border-color 0.15s;
    }
    .dark .block-settings-panel input[type="text"],
    .dark .block-settings-panel select {
        background: #0f172a;
        border-color: #334155;
        color: #e2e8f0;
    }
    .block-settings-panel label {
        display: block;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #64748b;
        margin-bottom: 3px;
    }
    .dark .block-settings-panel label {
        color: #94a3b8;
    }
    /* Format buttons active state */
    .format-btn-active {
        background: rgba(34,113,177,0.12) !important;
        color: #2271b1 !important;
        border-color: rgba(34,113,177,0.45) !important;
    }
    .dark .format-btn-active {
        background: rgba(99,102,241,0.15) !important;
        color: #a5b4fc !important;
        border-color: rgba(99,102,241,0.45) !important;
    }
    /* Block container spacing — give breathing room between blocks */
    #blocks-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    /* Preset ratio buttons */
    .ratio-preset-btn {
        padding: 2px 6px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 3px;
        font-size: 9px;
        font-family: monospace;
        color: #475569;
        cursor: pointer;
        transition: background 0.15s;
    }
    .ratio-preset-btn:hover {
        background: #e2e8f0;
    }
    .dark .ratio-preset-btn {
        background: #1e293b;
        border-color: #334155;
        color: #94a3b8;
    }
    .dark .ratio-preset-btn:hover {
        background: #334155;
    }
    /* Empty state placeholder for blocks container */
    #blocks-empty-hint {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 16rem;
        color: #94a3b8;
        gap: 8px;
        pointer-events: none;
    }
    #blocks-container:not(:empty) #blocks-empty-hint {
        display: none;
    }
    /* Hex color text inputs — fixed narrow width, not full-width */
    .block-hex-input {
        width: 80px !important;
        font-family: monospace;
        font-size: 10px !important;
    }
    /* Thumbnail tab switcher */
    .thumb-tab {
        padding: 4px 12px;
        font-size: 11px;
        font-weight: 600;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.15s, color 0.15s;
        background: transparent;
        color: #64748b;
    }
    .thumb-tab.active {
        background: #2271b1;
        color: #fff;
        border-color: #2271b1;
    }
    .dark .thumb-tab {
        border-color: #334155;
        color: #94a3b8;
    }
    .dark .thumb-tab.active {
        background: #4f46e5;
        border-color: #4f46e5;
        color: #fff;
    }
</style>

<!-- Scripts for Gutenberg Block Editor -->
<script>
    const container = document.getElementById('blocks-container');
    const form = document.getElementById('publish-blog-form');
    const hiddenContentInput = document.getElementById('hidden-content');
    
    // Parses CSS padding shorthand string into top, right, bottom, left numeric object
    function parsePaddingShorthand(paddingStr) {
        const parseNum = (val) => {
            const num = parseFloat(val);
            return isNaN(num) ? 0 : num;
        };
        if (!paddingStr) return { top: 0, right: 0, bottom: 0, left: 0 };
        let cleanStr = paddingStr.replace('!important', '').trim();
        const parts = cleanStr.split(/\s+/);
        if (parts.length === 1) {
            const val = parseNum(parts[0]);
            return { top: val, right: val, bottom: val, left: val };
        } else if (parts.length === 2) {
            const v = parseNum(parts[0]), h = parseNum(parts[1]);
            return { top: v, right: h, bottom: v, left: h };
        } else if (parts.length === 3) {
            const t = parseNum(parts[0]), h = parseNum(parts[1]), b = parseNum(parts[2]);
            return { top: t, right: h, bottom: b, left: h };
        } else if (parts.length >= 4) {
            return {
                top: parseNum(parts[0]),
                right: parseNum(parts[1]),
                bottom: parseNum(parts[2]),
                left: parseNum(parts[3])
            };
        }
        return { top: 0, right: 0, bottom: 0, left: 0 };
    }

    // Formats and sanitizes a padding input value to a standard pixel unit
    function formatPaddingUnit(val) {
        const num = parseFloat(val);
        if (isNaN(num) || num < 0) return '0px';
        return num + 'px';
    }

    // Resolves unified shorthand padding string from TRBL input fields
    function getPaddingValue(block) {
        const padTop = block.querySelector('.block-padding-top') ? (block.querySelector('.block-padding-top').value.trim() || '0px') : '0px';
        const padRight = block.querySelector('.block-padding-right') ? (block.querySelector('.block-padding-right').value.trim() || '0px') : '0px';
        const padBottom = block.querySelector('.block-padding-bottom') ? (block.querySelector('.block-padding-bottom').value.trim() || '0px') : '0px';
        const padLeft = block.querySelector('.block-padding-left') ? (block.querySelector('.block-padding-left').value.trim() || '0px') : '0px';
        
        return `${formatPaddingUnit(padTop)} ${formatPaddingUnit(padRight)} ${formatPaddingUnit(padBottom)} ${formatPaddingUnit(padLeft)}`;
    }
    
    // Track insertion index
    let insertIndex = null;
    
    function toggleInserter(atIndex = null) {
        const panel = document.getElementById('block-inserter');
        panel.classList.toggle('translate-x-full');
        insertIndex = atIndex;
        if (!panel.classList.contains('translate-x-full')) {
            document.getElementById('block-search').focus();
        }
    }
    
    function filterBlocks() {
        const query = document.getElementById('block-search').value.toLowerCase();
        document.querySelectorAll('.block-card').forEach(card => {
            const label = card.querySelector('span').textContent.toLowerCase();
            if (label.includes(query)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    function insertSelectedBlock(type) {
        addBlock(type, '', {}, insertIndex);
        toggleInserter();
    }
    
    // Core function to add/insert a block
    function addBlock(type, content = '', styles = {}, atIndex = null) {
        const blockId = 'block_' + Date.now() + '_' + Math.floor(Math.random() * 1000);
        
        // Retrieve styles or defaults
        const textColor = styles.color || (type === 'button' ? '#ffffff' : (type === 'divider' ? '#cbd5e1' : '#1e293b'));
        const bgColor = styles.bgColor || (type === 'button' ? '#2271b1' : 'transparent');
        const fontSize = styles.fontSize || '16px';
        const fontWeight = styles.fontWeight || '400';
        const textAlign = styles.textAlign || (type === 'image' || type === 'video' || type === 'button' || type === 'divider' ? 'center' : 'left');
        const lineHeight = styles.lineHeight || '1.5';
        const padding = styles.padding || '0px';
        const borderRadius = styles.borderRadius || (type === 'columns' || type === 'image' || type === 'video' || type === 'button' ? '12px' : '0px');
        const isBold = styles.bold || false;
        const isItalic = styles.italic || false;
        const isUnderline = styles.underline || false;
        
        const columnOrder = styles.layout || '2'; // default 2 columns
        const columnRatio = styles.ratio || '1fr 1fr';
        
        const blockDiv = document.createElement('div');
        blockDiv.className = 'block-item bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 rounded p-4 relative space-y-3 shadow-sm transition-all text-slate-800 dark:text-slate-100';
        blockDiv.dataset.type = type;
        blockDiv.id = blockId;
        
        // Setup focus highlighting
        blockDiv.addEventListener('click', (e) => {
            if (e.target.closest('button, input, textarea, select')) return;
            document.querySelectorAll('.block-item').forEach(b => b.classList.remove('active-focus'));
            blockDiv.classList.add('active-focus');
        });
        
        let headerTitle = '';
        let innerHtml = '';
        let extraSettings = '';
        
        const textDecorators = `
            <div class="space-y-1 font-sans">
                <label>Formatting</label>
                <div class="flex items-center gap-1 mt-0.5">
                    <button type="button" onclick="toggleFormat('${blockId}', 'bold')" class="px-2.5 py-1 border border-slate-200 dark:border-slate-700 rounded font-bold text-xs format-bold transition-all cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-800 ${isBold ? 'format-btn-active' : ''}" title="Bold">B</button>
                    <button type="button" onclick="toggleFormat('${blockId}', 'italic')" class="px-2.5 py-1 border border-slate-200 dark:border-slate-700 rounded italic text-xs format-italic transition-all cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-800 ${isItalic ? 'format-btn-active' : ''}" title="Italic">I</button>
                    <button type="button" onclick="toggleFormat('${blockId}', 'underline')" class="px-2.5 py-1 border border-slate-200 dark:border-slate-700 rounded underline text-xs format-underline transition-all cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-800 ${isUnderline ? 'format-btn-active' : ''}" title="Underline">U</button>
                </div>
            </div>
        `;
        
        const paddingObj = parsePaddingShorthand(styles.padding || '0px');
        
        const trblPaddingSettings = `
            <div class="space-y-1 font-sans">
                <label class="block text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Padding (TRBL)</label>
                <div class="grid grid-cols-4 gap-1">
                    <input type="number" min="0" placeholder="0" class="block-padding-top w-full px-1 py-0.5 text-center border border-slate-200 dark:border-slate-700 text-xs rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:outline-none" value="${paddingObj.top}" oninput="applyStyles('${blockId}')" title="Top Padding">
                    <input type="number" min="0" placeholder="0" class="block-padding-right w-full px-1 py-0.5 text-center border border-slate-200 dark:border-slate-700 text-xs rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:outline-none" value="${paddingObj.right}" oninput="applyStyles('${blockId}')" title="Right Padding">
                    <input type="number" min="0" placeholder="0" class="block-padding-bottom w-full px-1 py-0.5 text-center border border-slate-200 dark:border-slate-700 text-xs rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:outline-none" value="${paddingObj.bottom}" oninput="applyStyles('${blockId}')" title="Bottom Padding">
                    <input type="number" min="0" placeholder="0" class="block-padding-left w-full px-1 py-0.5 text-center border border-slate-200 dark:border-slate-700 text-xs rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 focus:outline-none" value="${paddingObj.left}" oninput="applyStyles('${blockId}')" title="Left Padding">
                </div>
            </div>
        `;

        const coreTextOnlySettings = `
            <div class="space-y-1 font-sans">
                <label>Text Color</label>
                <div class="flex items-center gap-1.5">
                    <input type="color" class="w-6 h-6 border-0 bg-transparent cursor-pointer rounded-full overflow-hidden block-color" oninput="onPickerChange('${blockId}', 'text')" value="${textColor}">
                    <input type="text" class="block-hex-input px-1.5 py-1 border border-slate-200 dark:border-slate-700 rounded block-color-text focus:outline-none" oninput="syncColorInput('${blockId}', 'text')" placeholder="#1e293b" value="${textColor}">
                </div>
            </div>
            <div class="space-y-1 font-sans">
                <label class="block text-[9px] font-bold text-slate-455 dark:text-slate-500 uppercase tracking-wider">Font Size</label>
                <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-xs rounded bg-white dark:bg-slate-900 text-slate-850 dark:text-slate-200 block-size focus:outline-none" onchange="applyStyles('${blockId}')">
                    <option value="12px" ${fontSize === '12px' ? 'selected' : ''}>12px</option>
                    <option value="13px" ${fontSize === '13px' ? 'selected' : ''}>13px</option>
                    <option value="14px" ${fontSize === '14px' ? 'selected' : ''}>14px</option>
                    <option value="15px" ${fontSize === '15px' ? 'selected' : ''}>15px</option>
                    <option value="16px" ${fontSize === '16px' ? 'selected' : ''}>16px (Normal)</option>
                    <option value="17px" ${fontSize === '17px' ? 'selected' : ''}>17px</option>
                    <option value="18px" ${fontSize === '18px' ? 'selected' : ''}>18px</option>
                    <option value="20px" ${fontSize === '20px' ? 'selected' : ''}>20px</option>
                    <option value="22px" ${fontSize === '22px' ? 'selected' : ''}>22px</option>
                    <option value="24px" ${fontSize === '24px' ? 'selected' : ''}>24px</option>
                    <option value="26px" ${fontSize === '26px' ? 'selected' : ''}>26px</option>
                    <option value="28px" ${fontSize === '28px' ? 'selected' : ''}>28px</option>
                    <option value="30px" ${fontSize === '30px' ? 'selected' : ''}>30px</option>
                    <option value="32px" ${fontSize === '32px' ? 'selected' : ''}>32px</option>
                    <option value="36px" ${fontSize === '36px' ? 'selected' : ''}>36px</option>
                    <option value="40px" ${fontSize === '40px' ? 'selected' : ''}>40px</option>
                    <option value="44px" ${fontSize === '44px' ? 'selected' : ''}>44px</option>
                    <option value="48px" ${fontSize === '48px' ? 'selected' : ''}>48px</option>
                    <option value="56px" ${fontSize === '56px' ? 'selected' : ''}>56px</option>
                    <option value="64px" ${fontSize === '64px' ? 'selected' : ''}>64px</option>
                </select>
            </div>
            <div class="space-y-1 font-sans">
                <label class="block text-[9px] font-bold text-slate-455 dark:text-slate-500 uppercase tracking-wider">Text Align</label>
                <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-xs rounded bg-white dark:bg-slate-900 text-slate-850 dark:text-slate-200 block-align focus:outline-none" onchange="applyStyles('${blockId}')">
                    <option value="left" ${textAlign === 'left' ? 'selected' : ''}>Left</option>
                    <option value="center" ${textAlign === 'center' ? 'selected' : ''}>Center</option>
                    <option value="right" ${textAlign === 'right' ? 'selected' : ''}>Right</option>
                    <option value="justify" ${textAlign === 'justify' ? 'selected' : ''}>Justify</option>
                </select>
            </div>
            <div class="space-y-1 font-sans">
                <label class="block text-[9px] font-bold text-slate-455 dark:text-slate-500 uppercase tracking-wider">Font Weight</label>
                <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-xs rounded bg-white dark:bg-slate-900 text-slate-850 dark:text-slate-200 block-weight focus:outline-none" onchange="applyStyles('${blockId}')">
                    <option value="300" ${fontWeight === '300' ? 'selected' : ''}>Light (300)</option>
                    <option value="400" ${fontWeight === '400' ? 'selected' : ''}>Normal (400)</option>
                    <option value="500" ${fontWeight === '500' ? 'selected' : ''}>Medium (500)</option>
                    <option value="600" ${fontWeight === '600' ? 'selected' : ''}>Semi-Bold (600)</option>
                    <option value="700" ${fontWeight === '700' ? 'selected' : ''}>Bold (700)</option>
                </select>
            </div>
            <div class="space-y-1 font-sans">
                <label class="block text-[9px] font-bold text-slate-455 dark:text-slate-500 uppercase tracking-wider">Line Height</label>
                <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-700 text-xs rounded bg-white dark:bg-slate-900 text-slate-850 dark:text-slate-200 block-lineheight focus:outline-none" onchange="applyStyles('${blockId}')">
                    <option value="1.2" ${lineHeight === '1.2' ? 'selected' : ''}>Tight (1.2)</option>
                    <option value="1.5" ${lineHeight === '1.5' ? 'selected' : ''}>Normal (1.5)</option>
                    <option value="1.8" ${lineHeight === '1.8' ? 'selected' : ''}>Loose (1.8)</option>
                </select>
            </div>
        `;

        const coreTextSettings = `
            ${coreTextOnlySettings}
            <div class="space-y-1 font-sans">
                <label>Bg Color <button type="button" onclick="clearBgColor('${blockId}')" class="ml-1 text-[8px] text-rose-400 hover:text-rose-600 underline cursor-pointer">clear</button></label>
                <div class="flex items-center gap-1.5">
                    <input type="color" class="w-6 h-6 border-0 bg-transparent cursor-pointer rounded-full overflow-hidden block-bgcolor" oninput="onPickerChange('${blockId}', 'bg')" value="${bgColor === 'transparent' ? '#ffffff' : bgColor}">
                    <input type="text" class="block-hex-input px-1.5 py-1 border border-slate-200 dark:border-slate-700 rounded block-bgcolor-text focus:outline-none" oninput="syncColorInput('${blockId}', 'bg')" placeholder="Transparent" value="${bgColor === 'transparent' ? '' : bgColor}">
                </div>
            </div>
            ${trblPaddingSettings}
            <div class="space-y-1 font-sans">
                <label class="block text-[9px] font-bold text-slate-455 dark:text-slate-500 uppercase tracking-wider">Rounded Corner</label>
                <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-700 text-xs rounded bg-white dark:bg-slate-900 text-slate-850 dark:text-slate-200 block-radius focus:outline-none" onchange="applyStyles('${blockId}')">
                    <option value="0px" ${borderRadius === '0px' ? 'selected' : ''}>None</option>
                    <option value="6px" ${borderRadius === '6px' ? 'selected' : ''}>Small</option>
                    <option value="12px" ${borderRadius === '12px' ? 'selected' : ''}>Medium</option>
                    <option value="24px" ${borderRadius === '24px' ? 'selected' : ''}>Large</option>
                </select>
            </div>
        `;
        
        if (type === 'paragraph') {
            headerTitle = '<i class="fa-solid fa-paragraph"></i> Paragraph Block';
            innerHtml = `<textarea class="w-full px-3 py-2 border border-slate-200 dark:border-slate-800 rounded text-sm bg-slate-50/50 dark:bg-slate-900/40 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 block-input caret-[#2271b1] dark:caret-indigo-400 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-950 transition-colors" placeholder="Type paragraph content..." rows="3" oninput="previewBlock('${blockId}')">${content}</textarea>`;
            extraSettings = coreTextSettings + textDecorators;
        } else if (type === 'heading') {
            headerTitle = '<i class="fa-solid fa-heading"></i> Heading Block';
            const headingLevel = styles.level || 'h2';
            innerHtml = `
                <div class="flex gap-2">
                    <select class="px-2 py-1.5 border border-slate-200 dark:border-slate-800 text-xs rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 block-heading-level focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500" onchange="previewBlock('${blockId}')">
                        <option value="h2" ${headingLevel === 'h2' ? 'selected' : ''}>H2</option>
                        <option value="h3" ${headingLevel === 'h3' ? 'selected' : ''}>H3</option>
                        <option value="h4" ${headingLevel === 'h4' ? 'selected' : ''}>H4</option>
                    </select>
                    <input type="text" value="${content}" class="flex-grow px-3 py-1.5 border border-slate-200 dark:border-slate-800 rounded text-sm bg-slate-50/50 dark:bg-slate-900/40 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 block-input caret-[#2271b1] dark:caret-indigo-400 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-950 transition-colors" placeholder="Heading text..." oninput="previewBlock('${blockId}')">
                </div>
            `;
            extraSettings = coreTextSettings + textDecorators;
        } else if (type === 'quote') {
            headerTitle = '<i class="fa-solid fa-quote-left text-slate-400"></i> Quote Block';
            const citeText = styles.cite || '';
            const borderAccentColor = styles.borderColor || '#2271b1';
            innerHtml = `
                <div class="space-y-2 border-l-4 pl-4 border-[#2271b1] block-quote-container" style="border-color: ${borderAccentColor};">
                    <textarea class="w-full px-3 py-2 border border-slate-200 dark:border-slate-800 rounded text-sm italic bg-slate-50/50 dark:bg-slate-900/40 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 block-input caret-[#2271b1] dark:caret-indigo-400 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-950 transition-colors" placeholder="Enter quote content..." rows="3" oninput="previewBlock('${blockId}')">${content}</textarea>
                    <input type="text" value="${citeText}" class="w-full px-3 py-1.5 border border-slate-200 dark:border-slate-800 rounded text-xs bg-slate-50/50 dark:bg-slate-900/40 text-slate-650 dark:text-slate-350 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 block-quote-cite caret-[#2271b1] dark:caret-indigo-400 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-950 transition-colors" placeholder="— Citation Source / Author" oninput="previewBlock('${blockId}')">
                </div>
            `;
            extraSettings = `
                <div class="space-y-1 font-sans">
                    <label>Border Color</label>
                    <div class="flex items-center gap-1.5">
                        <input type="color" class="w-6 h-6 border-0 bg-transparent cursor-pointer rounded-full overflow-hidden block-border-color" oninput="onPickerChange('${blockId}', 'border')" value="${borderAccentColor}">
                        <input type="text" class="block-hex-input px-1.5 py-1 border border-slate-200 dark:border-slate-700 rounded block-border-color-text focus:outline-none" oninput="applyStyles('${blockId}')" value="${borderAccentColor}">
                    </div>
                </div>
                ${coreTextSettings}
                ${textDecorators}
            `;
        } else if (type === 'list') {
            headerTitle = '<i class="fa-solid fa-list-ul"></i> List Block';
            const listStyle = styles.listStyle || 'ul';
            innerHtml = `
                <div class="space-y-1.5 font-sans">
                    <div class="flex items-center justify-between">
                        <span class="text-[9px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-wider">List Items (One per line)</span>
                        <select class="text-[10px] border border-slate-200 dark:border-slate-800 rounded bg-white dark:bg-slate-900 text-slate-850 dark:text-slate-200 block-list-style focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500" onchange="previewBlock('${blockId}')">
                            <option value="ul" ${listStyle === 'ul' ? 'selected' : ''}>Unordered (Bullets)</option>
                            <option value="ol" ${listStyle === 'ol' ? 'selected' : ''}>Ordered (Numbers)</option>
                        </select>
                    </div>
                    <textarea class="w-full px-3 py-2 border border-slate-200 dark:border-slate-800 rounded text-sm bg-slate-50/50 dark:bg-slate-900/40 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 block-input caret-[#2271b1] dark:caret-indigo-400 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-950 transition-colors" placeholder="Item 1&#10;Item 2&#10;Item 3" rows="4" oninput="previewBlock('${blockId}')">${content}</textarea>
                </div>
            `;
            extraSettings = coreTextSettings;
        } else if (type === 'button') {
            headerTitle = '<i class="fa-solid fa-square-minus text-[#2271b1]"></i> CTA Button Block';
            const btnLink = styles.link || '#';
            innerHtml = `
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 font-sans">
                    <div class="space-y-1">
                        <label class="block text-[9px] uppercase font-bold text-slate-450 dark:text-slate-500 tracking-wider">Button Text</label>
                        <input type="text" value="${content || 'Click Here'}" class="w-full px-3 py-1.5 border border-slate-200 dark:border-slate-800 rounded text-xs bg-slate-50/50 dark:bg-slate-900/40 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 block-btn-text caret-[#2271b1] dark:caret-indigo-400 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-950 transition-colors" placeholder="Call to Action..." oninput="previewBlock('${blockId}')">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[9px] uppercase font-bold text-slate-450 dark:text-slate-500 tracking-wider">Target Link URL</label>
                        <input type="text" value="${btnLink}" class="w-full px-3 py-1.5 border border-slate-200 dark:border-slate-800 rounded text-xs bg-slate-50/50 dark:bg-slate-900/40 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 block-btn-link caret-[#2271b1] dark:caret-indigo-400 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-950 transition-colors" placeholder="https://example.com" oninput="previewBlock('${blockId}')">
                    </div>
                </div>
                <div class="py-3 flex justify-center block-btn-preview-container font-sans">
                    <span class="px-5 py-2 text-white bg-[#2271b1] rounded font-bold text-xs inline-block shadow-sm transition-all pointer-events-none block-button-element" style="background-color: ${bgColor === 'transparent' ? '#2271b1' : bgColor}; color: ${textColor}; border-radius: ${borderRadius};">${content || 'Click Here'}</span>
                </div>
            `;
            extraSettings = `
                <div class="space-y-1 font-sans">
                    <label>Alignment</label>
                    <select class="w-full block-align focus:outline-none" onchange="applyStyles('${blockId}')">
                        <option value="center" ${textAlign === 'center' ? 'selected' : ''}>Center</option>
                        <option value="left" ${textAlign === 'left' ? 'selected' : ''}>Left</option>
                        <option value="right" ${textAlign === 'right' ? 'selected' : ''}>Right</option>
                    </select>
                </div>
                <div class="space-y-1 font-sans">
                    <label>Button Bg Color</label>
                    <div class="flex items-center gap-1.5">
                        <input type="color" class="w-6 h-6 border-0 bg-transparent cursor-pointer rounded-full overflow-hidden block-bgcolor" oninput="onPickerChange('${blockId}', 'bg')" value="${bgColor === 'transparent' ? '#2271b1' : bgColor}">
                        <input type="text" class="block-hex-input px-1.5 py-1 border border-slate-200 dark:border-slate-700 rounded block-bgcolor-text focus:outline-none" oninput="syncColorInput('${blockId}', 'bg')" placeholder="#2271b1" value="${bgColor === 'transparent' ? '#2271b1' : bgColor}">
                    </div>
                </div>
                <div class="space-y-1 font-sans">
                    <label>Text Color</label>
                    <div class="flex items-center gap-1.5">
                        <input type="color" class="w-6 h-6 border-0 bg-transparent cursor-pointer rounded-full overflow-hidden block-color" oninput="onPickerChange('${blockId}', 'text')" value="${textColor === '#1e293b' ? '#ffffff' : textColor}">
                        <input type="text" class="block-hex-input px-1.5 py-1 border border-slate-200 dark:border-slate-700 rounded block-color-text focus:outline-none" oninput="syncColorInput('${blockId}', 'text')" placeholder="#ffffff" value="${textColor}">
                    </div>
                </div>
                <div class="space-y-1 font-sans">
                    <label>Button Rounded</label>
                    <select class="w-full block-radius focus:outline-none" onchange="applyStyles('${blockId}')">
                        <option value="6px" ${borderRadius === '6px' ? 'selected' : ''}>Small (6px)</option>
                        <option value="0px" ${borderRadius === '0px' ? 'selected' : ''}>Square (0px)</option>
                        <option value="12px" ${borderRadius === '12px' ? 'selected' : ''}>Medium (12px)</option>
                        <option value="24px" ${borderRadius === '24px' ? 'selected' : ''}>Round (24px)</option>
                    </select>
                </div>
                <div class="space-y-1 font-sans">
                    <label>Font Size</label>
                    <select class="w-full block-size focus:outline-none" onchange="applyStyles('${blockId}')">
                        <option value="12px" ${fontSize === '12px' ? 'selected' : ''}>12px</option>
                        <option value="13px" ${fontSize === '13px' ? 'selected' : ''}>13px</option>
                        <option value="14px" ${fontSize === '14px' ? 'selected' : ''}>14px</option>
                        <option value="15px" ${fontSize === '15px' ? 'selected' : ''}>15px</option>
                        <option value="16px" ${fontSize === '16px' ? 'selected' : ''}>16px</option>
                        <option value="18px" ${fontSize === '18px' ? 'selected' : ''}>18px</option>
                        <option value="20px" ${fontSize === '20px' ? 'selected' : ''}>20px</option>
                        <option value="24px" ${fontSize === '24px' ? 'selected' : ''}>24px</option>
                        <option value="28px" ${fontSize === '28px' ? 'selected' : ''}>28px</option>
                    </select>
                </div>
            `;
        } else if (type === 'divider') {
            headerTitle = '<i class="fa-solid fa-grip-lines"></i> Divider Line Block';
            const borderStyle = styles.borderStyle || 'solid';
            const borderThickness = styles.thickness || '1px';
            const dividerColor = styles.color || '#cbd5e1';
            
            innerHtml = `
                <div class="py-4 block-divider-preview-container">
                    <hr class="block-divider-element font-sans" style="border: 0; border-top: ${borderThickness} ${borderStyle} ${dividerColor};">
                </div>
            `;
            extraSettings = `
                <div class="space-y-1 font-sans">
                    <label>Line Style</label>
                    <select class="w-full block-divider-style focus:outline-none" onchange="applyStyles('${blockId}')">
                        <option value="solid" ${borderStyle === 'solid' ? 'selected' : ''}>Solid Line</option>
                        <option value="dashed" ${borderStyle === 'dashed' ? 'selected' : ''}>Dashed Line</option>
                        <option value="dotted" ${borderStyle === 'dotted' ? 'selected' : ''}>Dotted Line</option>
                    </select>
                </div>
                <div class="space-y-1 font-sans">
                    <label>Thickness</label>
                    <select class="w-full block-divider-thickness focus:outline-none" onchange="applyStyles('${blockId}')">
                        <option value="1px" ${borderThickness === '1px' ? 'selected' : ''}>Thin (1px)</option>
                        <option value="2px" ${borderThickness === '2px' ? 'selected' : ''}>Medium (2px)</option>
                        <option value="4px" ${borderThickness === '4px' ? 'selected' : ''}>Thick (4px)</option>
                    </select>
                </div>
                <div class="space-y-1 font-sans">
                    <label>Line Color</label>
                    <div class="flex items-center gap-1.5">
                        <input type="color" class="w-6 h-6 border-0 bg-transparent cursor-pointer rounded-full overflow-hidden block-color" oninput="onPickerChange('${blockId}', 'text')" value="${dividerColor}">
                        <input type="text" class="block-hex-input px-1.5 py-1 border border-slate-200 dark:border-slate-700 rounded block-color-text focus:outline-none" oninput="syncColorInput('${blockId}', 'text')" placeholder="#cbd5e1" value="${dividerColor}">
                    </div>
                </div>
            `;
        } else if (type === 'columns') {
            headerTitle = '<i class="fa-solid fa-columns"></i> Layout Section';
            
            // Build inner columns data for restore
            const col1Text = styles.col1Text || content || '';
            const col2Text = styles.col2Text || styles.col2Content || '';
            const col3Text = styles.col3Text || '';
            const col4Text = styles.col4Text || '';
            const col5Text = styles.col5Text || '';
            
            const col1Type = styles.col1Type || 'text';
            const col2Type = styles.col2Type || 'text';
            const col3Type = styles.col3Type || 'empty';
            const col4Type = styles.col4Type || 'empty';
            const col5Type = styles.col5Type || 'empty';
            
            const col1ImgUrl = styles.col1ImgUrl || '';
            const col2ImgUrl = styles.col2ImgUrl || styles.imgUrl || '';
            const col3ImgUrl = styles.col3ImgUrl || '';
            const col4ImgUrl = styles.col4ImgUrl || '';
            const col5ImgUrl = styles.col5ImgUrl || '';
            
            const col1ImgAlt = styles.col1ImgAlt || '';
            const col2ImgAlt = styles.col2ImgAlt || styles.imgAlt || '';
            const col3ImgAlt = styles.col3ImgAlt || '';
            const col4ImgAlt = styles.col4ImgAlt || '';
            const col5ImgAlt = styles.col5ImgAlt || '';
            
            extraSettings = `
                <div class="space-y-1 font-sans">
                    <label class="block text-[9px] font-bold text-slate-455 dark:text-slate-500 uppercase tracking-wider">Number of Columns</label>
                    <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-xs rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 block-layout focus:outline-none" onchange="changeSectionLayout('${blockId}')">
                        <option value="1" ${columnOrder === '1' ? 'selected' : ''}>1 Column</option>
                        <option value="2" ${columnOrder === '2' ? 'selected' : ''}>2 Columns</option>
                        <option value="3" ${columnOrder === '3' ? 'selected' : ''}>3 Columns</option>
                        <option value="4" ${columnOrder === '4' ? 'selected' : ''}>4 Columns</option>
                        <option value="5" ${columnOrder === '5' ? 'selected' : ''}>5 Columns</option>
                    </select>
                </div>
                <div class="space-y-1 font-sans">
                    <label class="block text-[9px] font-bold text-slate-455 dark:text-slate-500 uppercase tracking-wider">Column Widths / Ratio</label>
                    <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-xs rounded bg-white dark:bg-slate-900 text-slate-850 dark:text-slate-250 block-ratio focus:outline-none" data-initial-ratio="${columnRatio}" onchange="applyStyles('${blockId}')">
                        <!-- Populated dynamically by changeSectionLayout -->
                    </select>
                </div>
                <div class="space-y-1 font-sans">
                    <label>Bg Color <button type="button" onclick="clearBgColor('${blockId}')" class="ml-1 text-[8px] text-rose-400 hover:text-rose-600 underline cursor-pointer">clear</button></label>
                    <div class="flex items-center gap-1.5">
                        <input type="color" class="w-6 h-6 border-0 bg-transparent cursor-pointer rounded-full overflow-hidden block-bgcolor" oninput="onPickerChange('${blockId}', 'bg')" value="${bgColor === 'transparent' ? '#ffffff' : bgColor}">
                        <input type="text" class="block-hex-input px-1.5 py-1 border border-slate-200 dark:border-slate-700 rounded block-bgcolor-text focus:outline-none" oninput="syncColorInput('${blockId}', 'bg')" placeholder="Transparent" value="${bgColor === 'transparent' ? '' : bgColor}">
                    </div>
                </div>
                ${trblPaddingSettings}
                <div class="space-y-1 font-sans">
                    <label class="block text-[9px] font-bold text-slate-455 dark:text-slate-500 uppercase tracking-wider">Rounded Corner</label>
                    <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-xs rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 block-radius focus:outline-none" onchange="applyStyles('${blockId}')">
                        <option value="12px" ${borderRadius === '12px' ? 'selected' : ''}>Medium (12px)</option>
                        <option value="0px" ${borderRadius === '0px' ? 'selected' : ''}>Square (0px)</option>
                        <option value="6px" ${borderRadius === '6px' ? 'selected' : ''}>Small (6px)</option>
                        <option value="24px" ${borderRadius === '24px' ? 'selected' : ''}>Large (24px)</option>
                    </select>
                </div>
                ${coreTextOnlySettings}
                ${textDecorators}
            `;
            
            innerHtml = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 block-columns-grid transition-all font-sans">
                    <!-- Column 1 Slot -->
                    <div class="relative p-3 border border-slate-200/50 dark:border-slate-800/80 rounded bg-slate-50/30 dark:bg-slate-950/10 space-y-2 block-column-slot" data-index="1">
                        <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800/60 pb-1 select-none">
                            <span class="text-[9px] uppercase font-bold text-slate-450 dark:text-slate-500">Column 1</span>
                            <div class="flex items-center gap-1.5">
                                <button type="button" onclick="toggleSlotSettings('${blockId}', 1)" class="slot-settings-btn text-[9px] border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 px-1 py-0.5 rounded text-slate-650 dark:text-slate-350 cursor-pointer ${col1Type === 'empty' ? 'hidden' : ''}" title="Column Styles">
                                    <i class="fa-solid fa-sliders"></i> Styles
                                </button>
                                <select class="text-[10px] border border-slate-200 dark:border-slate-800 rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 block-slot-type focus:outline-none" onchange="changeColumnSlotType('${blockId}', 1)">
                                    <option value="text" ${col1Type === 'text' ? 'selected' : ''}>Text</option>
                                    <option value="image" ${col1Type === 'image' ? 'selected' : ''}>Image</option>
                                    <option value="video" ${col1Type === 'video' ? 'selected' : ''}>Video</option>
                                    <option value="empty" ${col1Type === 'empty' ? 'selected' : ''}>Empty</option>
                                </select>
                            </div>
                        </div>
                        <div class="slot-settings-panel hidden p-3 border border-slate-200 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-900/30 space-y-3 mb-2 rounded-lg transition-all">
                            ${renderSlotSettingsHTML(blockId, 1, col1Type, {
                                color: styles.col1Color,
                                bgColor: styles.col1BgColor,
                                fontSize: styles.col1FontSize,
                                fontWeight: styles.col1FontWeight,
                                textAlign: styles.col1TextAlign,
                                lineHeight: styles.col1LineHeight,
                                padding: styles.col1Padding,
                                borderRadius: styles.col1BorderRadius,
                                bold: styles.col1Bold,
                                italic: styles.col1Italic,
                                underline: styles.col1Underline
                            })}
                        </div>
                        <div class="slot-content font-sans">
                            ${renderSlotHTML(blockId, 1, col1Type, col1Text, col1ImgUrl, col1ImgAlt)}
                        </div>
                    </div>

                    <!-- Column 2 Slot -->
                    <div class="relative p-3 border border-slate-200/50 dark:border-slate-800/80 rounded bg-slate-50/30 dark:bg-slate-950/10 space-y-2 block-column-slot" data-index="2">
                        <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800/60 pb-1 select-none">
                            <span class="text-[9px] uppercase font-bold text-slate-450 dark:text-slate-500">Column 2</span>
                            <div class="flex items-center gap-1.5">
                                <button type="button" onclick="toggleSlotSettings('${blockId}', 2)" class="slot-settings-btn text-[9px] border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 px-1 py-0.5 rounded text-slate-650 dark:text-slate-350 cursor-pointer ${col2Type === 'empty' ? 'hidden' : ''}" title="Column Styles">
                                    <i class="fa-solid fa-sliders"></i> Styles
                                </button>
                                <select class="text-[10px] border border-slate-200 dark:border-slate-800 rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 block-slot-type focus:outline-none" onchange="changeColumnSlotType('${blockId}', 2)">
                                    <option value="text" ${col2Type === 'text' ? 'selected' : ''}>Text</option>
                                    <option value="image" ${col2Type === 'image' ? 'selected' : ''}>Image</option>
                                    <option value="video" ${col2Type === 'video' ? 'selected' : ''}>Video</option>
                                    <option value="empty" ${col2Type === 'empty' ? 'selected' : ''}>Empty</option>
                                </select>
                            </div>
                        </div>
                        <div class="slot-settings-panel hidden p-3 border border-slate-200 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-900/30 space-y-3 mb-2 rounded-lg transition-all">
                            ${renderSlotSettingsHTML(blockId, 2, col2Type, {
                                color: styles.col2Color,
                                bgColor: styles.col2BgColor,
                                fontSize: styles.col2FontSize,
                                fontWeight: styles.col2FontWeight,
                                textAlign: styles.col2TextAlign,
                                lineHeight: styles.col2LineHeight,
                                padding: styles.col2Padding,
                                borderRadius: styles.col2BorderRadius,
                                bold: styles.col2Bold,
                                italic: styles.col2Italic,
                                underline: styles.col2Underline
                            })}
                        </div>
                        <div class="slot-content font-sans">
                            ${renderSlotHTML(blockId, 2, col2Type, col2Text, col2ImgUrl, col2ImgAlt)}
                        </div>
                    </div>

                    <!-- Column 3 Slot -->
                    <div class="relative p-3 border border-slate-200/50 dark:border-slate-800/80 rounded bg-slate-50/30 dark:bg-slate-950/10 space-y-2 block-column-slot hidden" data-index="3">
                        <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800/60 pb-1 select-none">
                            <span class="text-[9px] uppercase font-bold text-slate-455 dark:text-slate-500">Column 3</span>
                            <div class="flex items-center gap-1.5">
                                <button type="button" onclick="toggleSlotSettings('${blockId}', 3)" class="slot-settings-btn text-[9px] border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 px-1 py-0.5 rounded text-slate-650 dark:text-slate-350 cursor-pointer ${col3Type === 'empty' ? 'hidden' : ''}" title="Column Styles">
                                    <i class="fa-solid fa-sliders"></i> Styles
                                </button>
                                <select class="text-[10px] border border-slate-200 dark:border-slate-800 rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 block-slot-type focus:outline-none" onchange="changeColumnSlotType('${blockId}', 3)">
                                    <option value="text" ${col3Type === 'text' ? 'selected' : ''}>Text</option>
                                    <option value="image" ${col3Type === 'image' ? 'selected' : ''}>Image</option>
                                    <option value="video" ${col3Type === 'video' ? 'selected' : ''}>Video</option>
                                    <option value="empty" ${col3Type === 'empty' ? 'selected' : ''}>Empty</option>
                                </select>
                            </div>
                        </div>
                        <div class="slot-settings-panel hidden p-3 border border-slate-200 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-900/30 space-y-3 mb-2 rounded-lg transition-all">
                            ${renderSlotSettingsHTML(blockId, 3, col3Type, {
                                color: styles.col3Color,
                                bgColor: styles.col3BgColor,
                                fontSize: styles.col3FontSize,
                                fontWeight: styles.col3FontWeight,
                                textAlign: styles.col3TextAlign,
                                lineHeight: styles.col3LineHeight,
                                padding: styles.col3Padding,
                                borderRadius: styles.col3BorderRadius,
                                bold: styles.col3Bold,
                                italic: styles.col3Italic,
                                underline: styles.col3Underline
                            })}
                        </div>
                        <div class="slot-content font-sans">
                            ${renderSlotHTML(blockId, 3, col3Type, col3Text, col3ImgUrl, col3ImgAlt)}
                        </div>
                    </div>

                    <!-- Column 4 Slot -->
                    <div class="relative p-3 border border-slate-200/50 dark:border-slate-800/80 rounded bg-slate-50/30 dark:bg-slate-950/10 space-y-2 block-column-slot hidden" data-index="4">
                        <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800/60 pb-1 select-none">
                            <span class="text-[9px] uppercase font-bold text-slate-455 dark:text-slate-500">Column 4</span>
                            <div class="flex items-center gap-1.5">
                                <button type="button" onclick="toggleSlotSettings('${blockId}', 4)" class="slot-settings-btn text-[9px] border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 px-1 py-0.5 rounded text-slate-650 dark:text-slate-350 cursor-pointer ${col4Type === 'empty' ? 'hidden' : ''}" title="Column Styles">
                                    <i class="fa-solid fa-sliders"></i> Styles
                                </button>
                                <select class="text-[10px] border border-slate-200 dark:border-slate-800 rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 block-slot-type focus:outline-none" onchange="changeColumnSlotType('${blockId}', 4)">
                                    <option value="text" ${col4Type === 'text' ? 'selected' : ''}>Text</option>
                                    <option value="image" ${col4Type === 'image' ? 'selected' : ''}>Image</option>
                                    <option value="video" ${col4Type === 'video' ? 'selected' : ''}>Video</option>
                                    <option value="empty" ${col4Type === 'empty' ? 'selected' : ''}>Empty</option>
                                </select>
                            </div>
                        </div>
                        <div class="slot-settings-panel hidden p-3 border border-slate-200 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-900/30 space-y-3 mb-2 rounded-lg transition-all">
                            ${renderSlotSettingsHTML(blockId, 4, col4Type, {
                                color: styles.col4Color,
                                bgColor: styles.col4BgColor,
                                fontSize: styles.col4FontSize,
                                fontWeight: styles.col4FontWeight,
                                textAlign: styles.col4TextAlign,
                                lineHeight: styles.col4LineHeight,
                                padding: styles.col4Padding,
                                borderRadius: styles.col4BorderRadius,
                                bold: styles.col4Bold,
                                italic: styles.col4Italic,
                                underline: styles.col4Underline
                            })}
                        </div>
                        <div class="slot-content font-sans">
                            ${renderSlotHTML(blockId, 4, col4Type, col4Text, col4ImgUrl, col4ImgAlt)}
                        </div>
                    </div>

                    <!-- Column 5 Slot -->
                    <div class="relative p-3 border border-slate-200/50 dark:border-slate-800/80 rounded bg-slate-50/30 dark:bg-slate-950/10 space-y-2 block-column-slot hidden" data-index="5">
                        <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800/60 pb-1 select-none">
                            <span class="text-[9px] uppercase font-bold text-slate-455 dark:text-slate-500">Column 5</span>
                            <div class="flex items-center gap-1.5">
                                <button type="button" onclick="toggleSlotSettings('${blockId}', 5)" class="slot-settings-btn text-[9px] border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 px-1 py-0.5 rounded text-slate-650 dark:text-slate-350 cursor-pointer ${col5Type === 'empty' ? 'hidden' : ''}" title="Column Styles">
                                    <i class="fa-solid fa-sliders"></i> Styles
                                </button>
                                <select class="text-[10px] border border-slate-200 dark:border-slate-800 rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 block-slot-type focus:outline-none" onchange="changeColumnSlotType('${blockId}', 5)">
                                    <option value="text" ${col5Type === 'text' ? 'selected' : ''}>Text</option>
                                    <option value="image" ${col5Type === 'image' ? 'selected' : ''}>Image</option>
                                    <option value="video" ${col5Type === 'video' ? 'selected' : ''}>Video</option>
                                    <option value="empty" ${col5Type === 'empty' ? 'selected' : ''}>Empty</option>
                                </select>
                            </div>
                        </div>
                        <div class="slot-settings-panel hidden p-3 border border-slate-200 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-900/30 space-y-3 mb-2 rounded-lg transition-all">
                            ${renderSlotSettingsHTML(blockId, 5, col5Type, {
                                color: styles.col5Color,
                                bgColor: styles.col5BgColor,
                                fontSize: styles.col5FontSize,
                                fontWeight: styles.col5FontWeight,
                                textAlign: styles.col5TextAlign,
                                lineHeight: styles.col5LineHeight,
                                padding: styles.col5Padding,
                                borderRadius: styles.col5BorderRadius,
                                bold: styles.col5Bold,
                                italic: styles.col5Italic,
                                underline: styles.col5Underline
                            })}
                        </div>
                        <div class="slot-content font-sans">
                            ${renderSlotHTML(blockId, 5, col5Type, col5Text, col5ImgUrl, col5ImgAlt)}
                        </div>
                    </div>
                </div>
            `;
        } else if (type === 'image') {
            headerTitle = '<i class="fa-solid fa-image"></i> Image Block';
            const imgAlt = styles.alt || '';
            extraSettings = `
                <div class="space-y-1 font-sans">
                    <label class="block text-[9px] font-bold text-slate-455 dark:text-slate-550 uppercase tracking-wider">Alignment</label>
                    <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-xs rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 block-align focus:outline-none" onchange="applyStyles('${blockId}')">
                        <option value="center" ${textAlign === 'center' ? 'selected' : ''}>Center</option>
                        <option value="left" ${textAlign === 'left' ? 'selected' : ''}>Left</option>
                        <option value="right" ${textAlign === 'right' ? 'selected' : ''}>Right</option>
                    </select>
                </div>
                <div class="space-y-1 font-sans">
                    <label class="block text-[9px] font-bold text-slate-455 dark:text-slate-550 uppercase tracking-wider">Rounded Corner</label>
                    <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-xs rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 block-radius focus:outline-none" onchange="applyStyles('${blockId}')">
                        <option value="12px" ${borderRadius === '12px' ? 'selected' : ''}>Medium (12px)</option>
                        <option value="0px" ${borderRadius === '0px' ? 'selected' : ''}>Square (0px)</option>
                        <option value="6px" ${borderRadius === '6px' ? 'selected' : ''}>Small (6px)</option>
                        <option value="24px" ${borderRadius === '24px' ? 'selected' : ''}>Large (24px)</option>
                    </select>
                </div>
            `;
            innerHtml = `
                <div class="space-y-2">
                    <input type="text" value="${content}" class="w-full px-3 py-2 border border-slate-200 dark:border-slate-800 rounded text-sm bg-slate-50/50 dark:bg-slate-900/40 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 block-image-url caret-[#2271b1] dark:caret-indigo-400 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-950 transition-colors" placeholder="Image URL..." oninput="previewBlock('${blockId}')">
                    <input type="text" value="${imgAlt}" class="w-full px-3 py-1.5 border border-slate-200 dark:border-slate-800 rounded text-xs bg-slate-50/50 dark:bg-slate-900/40 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 block-image-alt caret-[#2271b1] dark:caret-indigo-400 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-950 transition-colors" placeholder="Alt description (optional)..." oninput="previewBlock('${blockId}')">
                    <div class="block-media-preview ${content ? '' : 'hidden'} max-w-[280px] h-[160px] border border-slate-200 dark:border-slate-800 rounded overflow-hidden mt-2 bg-slate-100 dark:bg-slate-950 mx-auto animate-fadeIn font-sans">
                        <img src="${content}" class="w-full h-full object-cover">
                    </div>
                </div>
            `;
        } else if (type === 'video') {
            headerTitle = '<i class="fa-solid fa-video"></i> Video Block';
            extraSettings = `
                <div class="space-y-1">
                    <label class="block text-[9px] font-bold text-slate-455 dark:text-slate-550 uppercase tracking-wider">Alignment</label>
                    <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-xs rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 block-align focus:outline-none" onchange="applyStyles('${blockId}')">
                        <option value="center" ${textAlign === 'center' ? 'selected' : ''}>Center</option>
                        <option value="left" ${textAlign === 'left' ? 'selected' : ''}>Left</option>
                        <option value="right" ${textAlign === 'right' ? 'selected' : ''}>Right</option>
                    </select>
                </div>
                <div class="space-y-1">
                    <label class="block text-[9px] font-bold text-slate-455 dark:text-slate-550 uppercase tracking-wider">Rounded Corner</label>
                    <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-xs rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-200 block-radius focus:outline-none" onchange="applyStyles('${blockId}')">
                        <option value="12px" ${borderRadius === '12px' ? 'selected' : ''}>Medium (12px)</option>
                        <option value="0px" ${borderRadius === '0px' ? 'selected' : ''}>Square (0px)</option>
                        <option value="6px" ${borderRadius === '6px' ? 'selected' : ''}>Small (6px)</option>
                        <option value="24px" ${borderRadius === '24px' ? 'selected' : ''}>Large (24px)</option>
                    </select>
                </div>
            `;
            innerHtml = `
                <div class="space-y-2">
                    <input type="text" value="${content}" class="w-full px-3 py-2 border border-slate-200 dark:border-slate-800 rounded text-sm bg-slate-50/50 dark:bg-slate-900/40 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 block-video-url caret-[#2271b1] dark:caret-indigo-400 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-950 transition-colors" placeholder="YouTube Video URL or embed HTML..." oninput="previewBlock('${blockId}')">
                    <div class="block-media-preview ${content ? '' : 'hidden'} aspect-video max-w-sm border border-slate-200 dark:border-slate-800 rounded overflow-hidden mt-2 bg-slate-100 dark:bg-slate-950 flex items-center justify-center mx-auto">
                        ${content ? getEmbedIframe(content) : ''}
                    </div>
                </div>
            `;
        }
        
        blockDiv.innerHTML = `
            <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-2 mb-2 font-sans select-none">
                <div class="flex items-center gap-1.5">
                    <span class="text-[10px] uppercase font-bold text-slate-500 dark:text-slate-400 flex items-center gap-1.5">
                        ${headerTitle}
                    </span>
                    <button type="button" onclick="moveBlockUp('${blockId}')" class="p-1 hover:bg-slate-100 dark:hover:bg-slate-800 rounded text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 transition-colors cursor-pointer" title="Move Up"><i class="fa-solid fa-chevron-up text-[10px]"></i></button>
                    <button type="button" onclick="moveBlockDown('${blockId}')" class="p-1 hover:bg-slate-100 dark:hover:bg-slate-800 rounded text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 transition-colors cursor-pointer" title="Move Down"><i class="fa-solid fa-chevron-down text-[10px]"></i></button>
                </div>
                
                <div class="flex items-center gap-1.5 select-none">
                    <button type="button" onclick="toggleSettings('${blockId}')" class="px-2 py-0.5 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 text-[10px] font-semibold text-slate-600 dark:text-slate-300 rounded flex items-center gap-1 transition-all cursor-pointer" title="Toggle style settings">
                        <i class="fa-solid fa-sliders text-[9px]"></i> Styles
                    </button>
                    <button type="button" onclick="deleteBlock('${blockId}')" class="px-1.5 py-0.5 hover:bg-rose-50 dark:hover:bg-rose-500/10 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 rounded transition-colors cursor-pointer flex items-center gap-1 border border-transparent hover:border-rose-200 dark:hover:border-rose-500/30 text-[10px]" title="Delete Block"><i class="fa-solid fa-trash-can text-[10px]"></i></button>
                </div>
            </div>
            
            <!-- Collapsible Settings Panel — uses JS .open class, NOT Tailwind hidden (avoids display conflict) -->
            <div class="block-settings-panel">
                ${extraSettings}
            </div>
            
            <div class="block-content font-sans">
                ${innerHtml}
            </div>

            <!-- Inline Inserter Hover Overlay — positioned below block edge -->
            <div class="block-spacer-inserter-wrapper select-none">
                <div class="inserter-line"></div>
                <button type="button" onclick="toggleInserter(getBlockIndex('${blockId}') + 1)" class="h-5 w-5 bg-[#2271b1] hover:bg-[#135e96] dark:bg-indigo-600 dark:hover:bg-indigo-500 text-white rounded-full flex items-center justify-center shadow-md transition-all duration-150 transform hover:scale-110 cursor-pointer z-10 relative" title="Insert block here">
                    <i class="fa-solid fa-plus text-[9px]"></i>
                </button>
            </div>
        `;
        
        if (atIndex !== null && atIndex < container.children.length) {
            container.insertBefore(blockDiv, container.children[atIndex]);
        } else {
            container.appendChild(blockDiv);
        }
        
        applyStyles(blockId);
        if (type === 'columns') {
            changeSectionLayout(blockId);
        }
    }
    
    // Toggle collapsible settings panel — uses .open class (display:grid) instead of Tailwind hidden
    function toggleSettings(blockId) {
        const block = document.getElementById(blockId);
        const settings = block.querySelector('.block-settings-panel');
        if (!settings) return;
        settings.classList.toggle('open');
        // Update button label
        const btn = block.querySelector('button[onclick^="toggleSettings"]');
        if (btn) {
            const isOpen = settings.classList.contains('open');
            btn.innerHTML = `<i class="fa-solid fa-sliders text-[9px]"></i> ${isOpen ? 'Hide' : 'Styles'}`;
        }
    }
    
    // Get block index inside container
    function getBlockIndex(blockId) {
        const block = document.getElementById(blockId);
        return Array.from(container.children).indexOf(block);
    }
    
    // Slot renderer helper
    function renderSlotHTML(blockId, slotIdx, type, text = '', imgUrl = '', imgAlt = '') {
        if (type === 'text') {
            const headingVal = text.includes('###') ? text.split('###')[0].trim() : '';
            const bodyVal   = text.includes('###') ? text.split('###')[1].trim() : text;
            return `
                <div class="space-y-1 font-sans">
                    <input type="text" placeholder="Optional sub-heading..." class="block-input-heading w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-xs rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 caret-[#2271b1] dark:caret-indigo-400 placeholder-slate-400 dark:placeholder-slate-500" value="${headingVal}" oninput="applyStyles('${blockId}')">
                    <textarea class="block-input w-full px-2 py-1.5 border border-slate-200 dark:border-slate-800 text-xs rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 caret-[#2271b1] dark:caret-indigo-400 placeholder-slate-400 dark:placeholder-slate-500" placeholder="Compose column text..." rows="4" oninput="applyStyles('${blockId}')">${bodyVal}</textarea>
                </div>
            `;
        } else if (type === 'image') {
            return `
                <div class="space-y-1.5 font-sans">
                    <input type="text" value="${imgUrl}" class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-[10px] rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 caret-[#2271b1] dark:caret-indigo-400" placeholder="Image URL..." oninput="previewBlock('${blockId}')">
                    <input type="text" value="${imgAlt}" class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-[9px] rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 caret-[#2271b1] dark:caret-indigo-400" placeholder="Alt text..." oninput="previewBlock('${blockId}')">
                    <div class="block-media-preview ${imgUrl ? '' : 'hidden'} w-full h-24 border border-slate-200 dark:border-slate-800 rounded overflow-hidden bg-slate-100 dark:bg-slate-950">
                        <img src="${imgUrl}" class="w-full h-full object-cover">
                    </div>
                </div>
            `;
        } else if (type === 'video') {
            return `
                <div class="space-y-1.5 font-sans">
                    <input type="text" value="${imgUrl}" class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-[10px] rounded bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-1 focus:ring-[#2271b1] dark:focus:ring-indigo-500 caret-[#2271b1] dark:caret-indigo-400" placeholder="Video URL / Embed..." oninput="previewBlock('${blockId}')">
                    <div class="block-media-preview ${imgUrl ? '' : 'hidden'} aspect-video w-full border border-slate-200 dark:border-slate-800 rounded overflow-hidden bg-slate-100 dark:bg-slate-950 flex items-center justify-center">
                        ${imgUrl ? getEmbedIframe(imgUrl) : ''}
                    </div>
                </div>
            `;
        }
        return `<div class="py-4 text-center text-[10px] text-slate-450 dark:text-slate-500 italic">Empty Slot</div>`;
    }
    
    // Render individual slot specific settings
    function renderSlotSettingsHTML(blockId, slotIdx, type, slotStyles = {}) {
        if (type === 'empty') return '';
        
        const textColor = slotStyles.color || '#1e293b';
        const bgColor = slotStyles.bgColor || 'transparent';
        const fontSize = slotStyles.fontSize || '14px';
        const fontWeight = slotStyles.fontWeight || '400';
        const textAlign = slotStyles.textAlign || 'left';
        const lineHeight = slotStyles.lineHeight || '1.5';
        const padding = slotStyles.padding || '0px';
        const borderRadius = slotStyles.borderRadius || '0px';
        const isBold = slotStyles.bold || false;
        const isItalic = slotStyles.italic || false;
        const isUnderline = slotStyles.underline || false;
        
        const paddingObj = parsePaddingShorthand(padding);
        
        // Header info
        let fields = `
            <div class="flex items-center justify-between pb-1.5 border-b border-slate-100 dark:border-slate-800/85">
                <span class="text-[10px] font-semibold text-slate-500 dark:text-slate-400 flex items-center gap-1"><i class="fa-solid fa-sliders text-xs"></i> Column Slot Styles</span>
                <button type="button" onclick="toggleSlotSettings('${blockId}', ${slotIdx})" class="text-slate-400 hover:text-rose-500 text-xs cursor-pointer transition-colors p-0.5"><i class="fa-solid fa-xmark"></i></button>
            </div>
        `;
        
        // Formatting decorators
        const textDecorators = `
            <div class="space-y-1 font-sans">
                <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400">Formatting</label>
                <div class="flex items-center border border-slate-200 dark:border-slate-800 rounded overflow-hidden w-fit bg-slate-50 dark:bg-slate-900 mt-0.5">
                    <button type="button" onclick="toggleSlotFormat('${blockId}', ${slotIdx}, 'bold')" class="px-2.5 py-1 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 text-[10px] font-bold slot-format-bold transition-colors ${isBold ? 'bg-indigo-50/50 dark:bg-indigo-950/40 text-[#2271b1] dark:text-indigo-400 font-black' : ''}" title="Bold">B</button>
                    <button type="button" onclick="toggleSlotFormat('${blockId}', ${slotIdx}, 'italic')" class="px-2.5 py-1 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 text-[10px] italic slot-format-italic border-l border-slate-200 dark:border-slate-800 transition-colors ${isItalic ? 'bg-indigo-50/50 dark:bg-indigo-950/40 text-[#2271b1] dark:text-indigo-400' : ''}" title="Italic">I</button>
                    <button type="button" onclick="toggleSlotFormat('${blockId}', ${slotIdx}, 'underline')" class="px-2.5 py-1 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 text-[10px] underline slot-format-underline border-l border-slate-200 dark:border-slate-800 transition-colors ${isUnderline ? 'bg-indigo-50/50 dark:bg-indigo-950/40 text-[#2271b1] dark:text-indigo-400' : ''}" title="Underline">U</button>
                </div>
            </div>
        `;
        
        // Colors
        fields += `
            <div class="grid grid-cols-2 gap-2.5">
                <div class="space-y-1 font-sans">
                    <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400">Text Color</label>
                    <div class="flex items-center gap-1.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded p-1">
                        <input type="color" class="w-4 h-4 border-0 bg-transparent cursor-pointer rounded-full overflow-hidden slot-color" oninput="onSlotPickerChange('${blockId}', ${slotIdx}, 'text')" value="${textColor}">
                        <input type="text" class="block-hex-input w-full bg-transparent border-0 focus:ring-0 focus:outline-none p-0 text-[10px] text-slate-700 dark:text-slate-300 font-mono" oninput="syncSlotColorInput('${blockId}', ${slotIdx}, 'text')" placeholder="Inherit" value="${textColor}">
                    </div>
                </div>
                <div class="space-y-1 font-sans">
                    <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400 flex items-center justify-between">Bg Color <button type="button" onclick="clearSlotBgColor('${blockId}', ${slotIdx})" class="text-[8px] text-rose-400 hover:text-rose-500 underline cursor-pointer">clear</button></label>
                    <div class="flex items-center gap-1.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded p-1">
                        <input type="color" class="w-4 h-4 border-0 bg-transparent cursor-pointer rounded-full overflow-hidden slot-bgcolor" oninput="onSlotPickerChange('${blockId}', ${slotIdx}, 'bg')" value="${bgColor === 'transparent' ? '#ffffff' : bgColor}">
                        <input type="text" class="block-hex-input w-full bg-transparent border-0 focus:ring-0 focus:outline-none p-0 text-[10px] text-slate-700 dark:text-slate-350 font-mono" oninput="syncSlotColorInput('${blockId}', ${slotIdx}, 'bg')" placeholder="Trans" value="${bgColor === 'transparent' ? '' : bgColor}">
                    </div>
                </div>
            </div>
        `;
        
        if (type === 'text') {
            // Typography options
            fields += `
                <div class="grid grid-cols-2 gap-2.5">
                    <div class="space-y-1 font-sans">
                        <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400">Font Size</label>
                        <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-[10px] rounded bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 slot-size focus:outline-none" onchange="applySlotStyles('${blockId}', ${slotIdx})">
                            <option value="12px" ${fontSize === '12px' ? 'selected' : ''}>12px</option>
                            <option value="13px" ${fontSize === '13px' ? 'selected' : ''}>13px</option>
                            <option value="14px" ${fontSize === '14px' ? 'selected' : ''}>14px</option>
                            <option value="15px" ${fontSize === '15px' ? 'selected' : ''}>15px</option>
                            <option value="16px" ${fontSize === '16px' ? 'selected' : ''}>16px</option>
                            <option value="18px" ${fontSize === '18px' ? 'selected' : ''}>18px</option>
                            <option value="20px" ${fontSize === '20px' ? 'selected' : ''}>20px</option>
                            <option value="24px" ${fontSize === '24px' ? 'selected' : ''}>24px</option>
                            <option value="28px" ${fontSize === '28px' ? 'selected' : ''}>28px</option>
                            <option value="32px" ${fontSize === '32px' ? 'selected' : ''}>32px</option>
                        </select>
                    </div>
                    <div class="space-y-1 font-sans">
                        <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400">Text Align</label>
                        <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-[10px] rounded bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 slot-align focus:outline-none" onchange="applySlotStyles('${blockId}', ${slotIdx})">
                            <option value="left" ${textAlign === 'left' ? 'selected' : ''}>Left</option>
                            <option value="center" ${textAlign === 'center' ? 'selected' : ''}>Center</option>
                            <option value="right" ${textAlign === 'right' ? 'selected' : ''}>Right</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2.5">
                    <div class="space-y-1 font-sans">
                        <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400">Font Weight</label>
                        <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-[10px] rounded bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 slot-weight focus:outline-none" onchange="applySlotStyles('${blockId}', ${slotIdx})">
                            <option value="300" ${fontWeight === '300' ? 'selected' : ''}>Light</option>
                            <option value="400" ${fontWeight === '400' ? 'selected' : ''}>Normal</option>
                            <option value="700" ${fontWeight === '700' ? 'selected' : ''}>Bold</option>
                        </select>
                    </div>
                    <div class="space-y-1 font-sans">
                        <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400">Line Height</label>
                        <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-[10px] rounded bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 slot-lineheight focus:outline-none" onchange="applySlotStyles('${blockId}', ${slotIdx})">
                            <option value="1.2" ${lineHeight === '1.2' ? 'selected' : ''}>Tight</option>
                            <option value="1.5" ${lineHeight === '1.5' ? 'selected' : ''}>Normal</option>
                            <option value="1.8" ${lineHeight === '1.8' ? 'selected' : ''}>Loose</option>
                        </select>
                    </div>
                </div>
                ${textDecorators}
            `;
        }
        
        // Spacing & corners
        fields += `
            <div class="grid grid-cols-2 gap-2.5">
                <div class="space-y-1 font-sans">
                    <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400">Padding</label>
                    <div class="grid grid-cols-4 gap-1 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded p-1">
                        <input type="number" min="0" placeholder="0" class="slot-padding-top w-full bg-transparent border-0 text-center text-[10px] text-slate-700 dark:text-slate-350 p-0 focus:outline-none focus:ring-0 focus:ring-offset-0" value="${paddingObj.top}" oninput="applySlotStyles('${blockId}', ${slotIdx})" title="Top Padding">
                        <input type="number" min="0" placeholder="0" class="slot-padding-right w-full bg-transparent border-0 text-center text-[10px] text-slate-700 dark:text-slate-350 p-0 focus:outline-none focus:ring-0 focus:ring-offset-0" value="${paddingObj.right}" oninput="applySlotStyles('${blockId}', ${slotIdx})" title="Right Padding">
                        <input type="number" min="0" placeholder="0" class="slot-padding-bottom w-full bg-transparent border-0 text-center text-[10px] text-slate-700 dark:text-slate-350 p-0 focus:outline-none focus:ring-0 focus:ring-offset-0" value="${paddingObj.bottom}" oninput="applySlotStyles('${blockId}', ${slotIdx})" title="Bottom Padding">
                        <input type="number" min="0" placeholder="0" class="slot-padding-left w-full bg-transparent border-0 text-center text-[10px] text-slate-700 dark:text-slate-350 p-0 focus:outline-none focus:ring-0 focus:ring-offset-0" value="${paddingObj.left}" oninput="applySlotStyles('${blockId}', ${slotIdx})" title="Left Padding">
                    </div>
                </div>
                <div class="space-y-1 font-sans">
                    <label class="block text-[10px] font-medium text-slate-500 dark:text-slate-400">Corners</label>
                    <select class="w-full px-2 py-1 border border-slate-200 dark:border-slate-800 text-[10px] rounded bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 slot-radius focus:outline-none" onchange="applySlotStyles('${blockId}', ${slotIdx})">
                        <option value="0px" ${borderRadius === '0px' ? 'selected' : ''}>None</option>
                        <option value="6px" ${borderRadius === '6px' ? 'selected' : ''}>Small</option>
                        <option value="12px" ${borderRadius === '12px' ? 'selected' : ''}>Medium</option>
                    </select>
                </div>
            </div>
        `;
        
        return fields;
    }

    // Toggle slot settings drawer panel
    function toggleSlotSettings(blockId, slotIdx) {
        const block = document.getElementById(blockId);
        const slot = block.querySelector(`.block-column-slot[data-index="${slotIdx}"]`);
        const panel = slot.querySelector('.slot-settings-panel');
        if (panel) {
            panel.classList.toggle('hidden');
        }
    }

    // Apply styles to individual layout column slots
    function applySlotStyles(blockId, slotIdx) {
        const block = document.getElementById(blockId);
        const slot = block.querySelector(`.block-column-slot[data-index="${slotIdx}"]`);
        const type = slot.querySelector('.block-slot-type').value;
        
        if (type === 'empty') return;
        
        const colorTextInput = slot.querySelector('.slot-color-text');
        const color = colorTextInput ? (colorTextInput.value.trim() || '#1e293b') : '#1e293b';
        
        const bgTextInput = slot.querySelector('.slot-bgcolor-text');
        const bgColor = bgTextInput ? (bgTextInput.value.trim() || 'transparent') : 'transparent';
        
        const padTop = slot.querySelector('.slot-padding-top') ? (slot.querySelector('.slot-padding-top').value.trim() || '0px') : '0px';
        const padRight = slot.querySelector('.slot-padding-right') ? (slot.querySelector('.slot-padding-right').value.trim() || '0px') : '0px';
        const padBottom = slot.querySelector('.slot-padding-bottom') ? (slot.querySelector('.slot-padding-bottom').value.trim() || '0px') : '0px';
        const padLeft = slot.querySelector('.slot-padding-left') ? (slot.querySelector('.slot-padding-left').value.trim() || '0px') : '0px';
        
        const padding = `${formatPaddingUnit(padTop)} ${formatPaddingUnit(padRight)} ${formatPaddingUnit(padBottom)} ${formatPaddingUnit(padLeft)}`;
        
        const radius = slot.querySelector('.slot-radius') ? slot.querySelector('.slot-radius').value : '0px';
        
        const wrapper = slot.querySelector('.slot-content');
        if (wrapper) {
            wrapper.style.backgroundColor = bgColor;
            wrapper.style.padding = padding;
            wrapper.style.borderRadius = radius;
        }
        
        if (type === 'text') {
            const size = slot.querySelector('.slot-size') ? slot.querySelector('.slot-size').value : '14px';
            const align = slot.querySelector('.slot-align') ? slot.querySelector('.slot-align').value : 'left';
            const weight = slot.querySelector('.slot-weight') ? slot.querySelector('.slot-weight').value : '400';
            const lineHeight = slot.querySelector('.slot-lineheight') ? slot.querySelector('.slot-lineheight').value : '1.5';
            
            const isBold = slot.querySelector('.slot-format-bold') && slot.querySelector('.slot-format-bold').classList.contains('format-btn-active');
            const isItalic = slot.querySelector('.slot-format-italic') && slot.querySelector('.slot-format-italic').classList.contains('format-btn-active');
            const isUnderline = slot.querySelector('.slot-format-underline') && slot.querySelector('.slot-format-underline').classList.contains('format-btn-active');
            
            const inputs = slot.querySelectorAll('.block-input, .block-input-heading');
            inputs.forEach(input => {
                input.style.color = color;
                input.style.fontSize = size;
                input.style.textAlign = align;
                input.style.fontWeight = isBold ? 'bold' : weight;
                input.style.fontStyle = isItalic ? 'italic' : 'normal';
                input.style.textDecoration = isUnderline ? 'underline' : 'none';
                input.style.lineHeight = lineHeight;
            });
        }
        
        previewBlock(blockId);
    }

    // Called when slot color picker changes
    function onSlotPickerChange(blockId, slotIdx, colorType) {
        const block = document.getElementById(blockId);
        const slot = block.querySelector(`.block-column-slot[data-index="${slotIdx}"]`);
        let pickerSel = colorType === 'text' ? '.slot-color' : '.slot-bgcolor';
        let textSel = colorType === 'text' ? '.slot-color-text' : '.slot-bgcolor-text';
        
        const picker = slot.querySelector(pickerSel);
        const textInput = slot.querySelector(textSel);
        if (picker && textInput) textInput.value = picker.value;
        applySlotStyles(blockId, slotIdx);
    }
    
    // Clear slot background color
    function clearSlotBgColor(blockId, slotIdx) {
        const block = document.getElementById(blockId);
        const slot = block.querySelector(`.block-column-slot[data-index="${slotIdx}"]`);
        const bgTextInput = slot.querySelector('.slot-bgcolor-text');
        const bgPicker = slot.querySelector('.slot-bgcolor');
        if (bgTextInput) bgTextInput.value = '';
        if (bgPicker) bgPicker.value = '#ffffff';
        applySlotStyles(blockId, slotIdx);
    }
    
    // Sync slot color input text to color picker
    function syncSlotColorInput(blockId, slotIdx, type) {
        const block = document.getElementById(blockId);
        const slot = block.querySelector(`.block-column-slot[data-index="${slotIdx}"]`);
        const pickerClass = type === 'text' ? '.slot-color' : '.slot-bgcolor';
        const inputClass = type === 'text' ? '.slot-color-text' : '.slot-bgcolor-text';
        
        const picker = slot.querySelector(pickerClass);
        const textInput = slot.querySelector(inputClass);
        
        if (textInput.value === '') {
            applySlotStyles(blockId, slotIdx);
        } else if (/^#[0-9A-F]{6}$/i.test(textInput.value)) {
            picker.value = textInput.value;
            applySlotStyles(blockId, slotIdx);
        }
    }
    
    // Toggle bold/italic/underline formatting inside layout column slot
    function toggleSlotFormat(blockId, slotIdx, format) {
        const block = document.getElementById(blockId);
        const slot = block.querySelector(`.block-column-slot[data-index="${slotIdx}"]`);
        const btn = slot.querySelector(`.slot-format-${format}`);
        if (btn) {
            btn.classList.toggle('format-btn-active');
            applySlotStyles(blockId, slotIdx);
        }
    }

    // Change column slot type dynamically
    function changeColumnSlotType(blockId, slotIdx) {
        const block = document.getElementById(blockId);
        const slot = block.querySelector(`.block-column-slot[data-index="${slotIdx}"]`);
        const type = slot.querySelector('.block-slot-type').value;
        const container = slot.querySelector('.slot-content');
        const settingsPanel = slot.querySelector('.slot-settings-panel');
        
        container.innerHTML = renderSlotHTML(blockId, slotIdx, type);
        settingsPanel.innerHTML = renderSlotSettingsHTML(blockId, slotIdx, type);
        
        const stylesBtn = slot.querySelector('.slot-settings-btn');
        if (type === 'empty') {
            stylesBtn.classList.add('hidden');
            settingsPanel.classList.add('hidden');
        } else {
            stylesBtn.classList.remove('hidden');
        }
        
        applySlotStyles(blockId, slotIdx);
    }
    
    // Update presets structure layout
    function changeSectionLayout(blockId) {
        const block = document.getElementById(blockId);
        const colCount = parseInt(block.querySelector('.block-layout').value);
        const grid = block.querySelector('.block-columns-grid');
        const ratioSelect = block.querySelector('.block-ratio');
        
        let presets = [];
        if (colCount === 1) {
            presets = [{ label: '100%', val: '1fr' }];
        } else if (colCount === 2) {
            presets = [
                { label: '50% / 50%', val: '1fr 1fr' },
                { label: '66% / 33%', val: '2fr 1fr' },
                { label: '33% / 66%', val: '1fr 2fr' },
                { label: '75% / 25%', val: '3fr 1fr' },
                { label: '25% / 75%', val: '1fr 3fr' }
            ];
        } else if (colCount === 3) {
            presets = [
                { label: '33% / 33% / 33%', val: '1fr 1fr 1fr' },
                { label: '50% / 25% / 25%', val: '2fr 1fr 1fr' },
                { label: '25% / 50% / 25%', val: '1fr 2fr 1fr' },
                { label: '25% / 25% / 50%', val: '1fr 1fr 2fr' }
            ];
        } else if (colCount === 4) {
            presets = [
                { label: '25% / 25% / 25% / 25%', val: '1fr 1fr 1fr 1fr' },
                { label: '40% / 20% / 20% / 20%', val: '2fr 1fr 1fr 1fr' }
            ];
        } else if (colCount === 5) {
            presets = [
                { label: '20% / 20% / 20% / 20% / 20%', val: '1fr 1fr 1fr 1fr 1fr' }
            ];
        }
        
        const initialRatio = ratioSelect.dataset.initialRatio;
        ratioSelect.innerHTML = '';
        presets.forEach(p => {
            const opt = document.createElement('option');
            opt.value = p.val;
            opt.textContent = p.label;
            ratioSelect.appendChild(opt);
        });
        
        // Select matching preset or default
        if (initialRatio && presets.some(p => p.val === initialRatio)) {
            ratioSelect.value = initialRatio;
            delete ratioSelect.dataset.initialRatio;
        } else {
            ratioSelect.value = presets[0].val;
        }
        
        // Update Grid class lists
        if (colCount === 1) {
            grid.className = 'grid grid-cols-1 gap-4 block-columns-grid';
        } else if (colCount === 2) {
            grid.className = 'grid grid-cols-1 md:grid-cols-2 gap-4 block-columns-grid';
        } else if (colCount === 3) {
            grid.className = 'grid grid-cols-1 md:grid-cols-3 gap-4 block-columns-grid';
        } else if (colCount === 4) {
            grid.className = 'grid grid-cols-1 md:grid-cols-4 gap-4 block-columns-grid';
        } else if (colCount === 5) {
            grid.className = 'grid grid-cols-1 md:grid-cols-5 gap-4 block-columns-grid';
        }
        
        // Hide/Show Slots
        for (let i = 1; i <= 5; i++) {
            const slot = block.querySelector(`.block-column-slot[data-index="${i}"]`);
            if (i <= colCount) {
                slot.classList.remove('hidden');
                // Auto text type default if empty
                if (slot.querySelector('.block-slot-type').value === 'empty') {
                    slot.querySelector('.block-slot-type').value = 'text';
                    changeColumnSlotType(blockId, i);
                }
            } else {
                slot.classList.add('hidden');
            }
        }
        
        applyStyles(blockId);
        previewBlock(blockId);
    }
    
    // Called when a COLOR PICKER is dragged — syncs the matching text input first, then applies
    function onPickerChange(blockId, colorType) {
        const block = document.getElementById(blockId);
        let pickerSel, textSel;
        if (colorType === 'text') {
            pickerSel = '.block-color'; textSel = '.block-color-text';
        } else if (colorType === 'bg') {
            pickerSel = '.block-bgcolor'; textSel = '.block-bgcolor-text';
        } else if (colorType === 'border') {
            pickerSel = '.block-border-color'; textSel = '.block-border-color-text';
        }
        const picker = block.querySelector(pickerSel);
        const textInput = block.querySelector(textSel);
        // Sync text input to match picker BEFORE applyStyles reads it
        if (picker && textInput) textInput.value = picker.value;
        applyStyles(blockId);
    }

    // Clear background color (set to transparent)
    function clearBgColor(blockId) {
        const block = document.getElementById(blockId);
        const bgTextInput = block.querySelector('.block-bgcolor-text');
        const bgPicker = block.querySelector('.block-bgcolor');
        if (bgTextInput) bgTextInput.value = '';
        if (bgPicker) bgPicker.value = '#ffffff';
        applyStyles(blockId);
    }

    // Sync Color picker with hex input (called when user TYPES in the text box)
    function syncColorInput(blockId, type) {
        const block = document.getElementById(blockId);
        const pickerClass = type === 'text' ? '.block-color' : '.block-bgcolor';
        const inputClass = type === 'text' ? '.block-color-text' : '.block-bgcolor-text';
        
        const picker = block.querySelector(pickerClass);
        const textInput = block.querySelector(inputClass);
        
        if (textInput.value === '') {
            applyStyles(blockId);
        } else if (/^#[0-9A-F]{6}$/i.test(textInput.value)) {
            picker.value = textInput.value;
            applyStyles(blockId);
        }
    }
    
    // Apply styling options to visual preview input
    function applyStyles(blockId) {
        const block = document.getElementById(blockId);
        const type = block.dataset.type;
        
        // Read TEXT COLOR — from text input (kept in sync by onPickerChange / syncColorInput)
        const colorTextInput = block.querySelector('.block-color-text');
        const color = colorTextInput ? (colorTextInput.value.trim() || '#1e293b') : '#1e293b';

        // Read BG COLOR — empty text input = transparent (user cleared it or never set it)
        const bgTextInput = block.querySelector('.block-bgcolor-text');
        let bgColor = 'transparent';
        if (bgTextInput) {
            bgColor = bgTextInput.value.trim() || 'transparent';
        }
        
        const size = block.querySelector('.block-size') ? block.querySelector('.block-size').value : '16px';
        const align = block.querySelector('.block-align') ? block.querySelector('.block-align').value : 'center';
        const weight = block.querySelector('.block-weight') ? block.querySelector('.block-weight').value : '400';
        const lineHeight = block.querySelector('.block-lineheight') ? block.querySelector('.block-lineheight').value : '1.5';
        const padding = getPaddingValue(block);
        const radius = block.querySelector('.block-radius') ? block.querySelector('.block-radius').value : '6px';
        
        const isBold = block.querySelector('.format-bold') && block.querySelector('.format-bold').classList.contains('format-btn-active');
        const isItalic = block.querySelector('.format-italic') && block.querySelector('.format-italic').classList.contains('format-btn-active');
        const isUnderline = block.querySelector('.format-underline') && block.querySelector('.format-underline').classList.contains('format-btn-active');
        
        // Target textareas and inputs inside blocks
        let inputs = block.querySelectorAll('.block-input');
        inputs.forEach(input => {
            input.style.color = type === 'button' ? '#ffffff' : color;
            input.style.fontSize = size;
            input.style.textAlign = align;
            input.style.fontWeight = isBold ? 'bold' : weight;
            input.style.fontStyle = isItalic ? 'italic' : 'normal';
            input.style.textDecoration = isUnderline ? 'underline' : 'none';
            input.style.lineHeight = lineHeight;
        });

        // Apply background color to the block content wrapper (visible for ALL text-type blocks)
        const blockContent = block.querySelector('.block-content');
        if (blockContent && type !== 'button' && type !== 'divider' && type !== 'image' && type !== 'video') {
            if (bgColor !== 'transparent' && bgColor !== '') {
                blockContent.style.backgroundColor = bgColor;
                blockContent.style.padding = padding !== '0px' ? padding : '8px 12px';
                blockContent.style.borderRadius = radius !== '0px' ? radius : '6px';
            } else {
                blockContent.style.backgroundColor = '';
                blockContent.style.padding = '';
                blockContent.style.borderRadius = '';
            }
        }

        // Block specific styling actions
        if (type === 'image' || type === 'video') {
            const preview = block.querySelector('.block-media-preview');
            if (preview) {
                preview.style.borderRadius = radius;
                if (align === 'left') {
                    preview.style.marginLeft = '0';
                    preview.style.marginRight = 'auto';
                } else if (align === 'right') {
                    preview.style.marginLeft = 'auto';
                    preview.style.marginRight = '0';
                } else {
                    preview.style.marginLeft = 'auto';
                    preview.style.marginRight = 'auto';
                }
            }
        } else if (type === 'columns') {
            const gridContainer = block.querySelector('.block-columns-grid');
            const ratioVal = block.querySelector('.block-ratio').value.trim() || '1fr 1fr';
            
            if (gridContainer) {
                gridContainer.style.backgroundColor = bgColor;
                gridContainer.style.padding = padding;
                gridContainer.style.borderRadius = radius;
                gridContainer.style.gridTemplateColumns = ratioVal;
            }
            
            const colCount = parseInt(block.querySelector('.block-layout').value) || 2;
            for (let i = 1; i <= colCount; i++) {
                applySlotStyles(blockId, i);
            }
        } else if (type === 'quote') {
            const borderInput = block.querySelector('.block-border-color');
            const quoteBorder = block.querySelector('.block-quote-container');
            const borderVal = borderInput ? borderInput.value : '#2271b1';
            
            if (block.querySelector('.block-border-color-text')) {
                block.querySelector('.block-border-color-text').value = borderVal;
            }
            if (quoteBorder) {
                quoteBorder.style.borderColor = borderVal;
            }
        } else if (type === 'button') {
            const btnEl = block.querySelector('.block-button-element');
            const btnAlign = block.querySelector('.block-btn-preview-container');
            const buttonColorVal = block.querySelector('.block-bgcolor') ? block.querySelector('.block-bgcolor').value : '#2271b1';
            const buttonTextColorVal = block.querySelector('.block-color') ? block.querySelector('.block-color').value : '#ffffff';
            
            if (btnEl) {
                btnEl.style.backgroundColor = buttonColorVal;
                btnEl.style.color = buttonTextColorVal;
                btnEl.style.borderRadius = radius;
                btnEl.style.fontSize = size;
            }
            if (btnAlign) {
                if (align === 'left') {
                    btnAlign.className = 'py-3 flex justify-start block-btn-preview-container';
                } else if (align === 'right') {
                    btnAlign.className = 'py-3 flex justify-end block-btn-preview-container';
                } else {
                    btnAlign.className = 'py-3 flex justify-center block-btn-preview-container';
                }
            }
        } else if (type === 'divider') {
            const lineEl = block.querySelector('.block-divider-element');
            const dividerStyle = block.querySelector('.block-divider-style').value;
            const dividerThickness = block.querySelector('.block-divider-thickness').value;
            const dividerColor = color;
            
            if (lineEl) {
                lineEl.style.borderTop = `${dividerThickness} ${dividerStyle} ${dividerColor}`;
            }
        }
    }
    
    // Toggle block format (bold/italic/underline) — use stable CSS class instead of Tailwind JIT
    function toggleFormat(blockId, format) {
        const block = document.getElementById(blockId);
        const btn = block.querySelector(`.format-${format}`);
        if (!btn) return;
        btn.classList.toggle('format-btn-active');
        applyStyles(blockId);
    }
    
    // Delete block
    function deleteBlock(blockId) {
        const block = document.getElementById(blockId);
        block.remove();
    }
    
    // Reorder block up
    function moveBlockUp(blockId) {
        const block = document.getElementById(blockId);
        const prev = block.previousElementSibling;
        if (prev && prev.classList.contains('block-item')) {
            container.insertBefore(block, prev);
        }
    }
    
    // Reorder block down
    function moveBlockDown(blockId) {
        const block = document.getElementById(blockId);
        const next = block.nextElementSibling;
        if (next && next.classList.contains('block-item')) {
            container.insertBefore(next, block);
        }
    }
    
    // Live previews for Media and lists
    function previewBlock(blockId) {
        const block = document.getElementById(blockId);
        const type = block.dataset.type;
        
        if (type === 'image') {
            const url = block.querySelector('.block-image-url').value;
            const preview = block.querySelector('.block-media-preview');
            const img = preview.querySelector('img');
            if (url) {
                img.src = url;
                preview.classList.remove('hidden');
            } else {
                preview.classList.add('hidden');
            }
        } else if (type === 'video') {
            const url = block.querySelector('.block-video-url').value;
            const preview = block.querySelector('.block-media-preview');
            if (url) {
                preview.innerHTML = getEmbedIframe(url);
                preview.classList.remove('hidden');
            } else {
                preview.classList.add('hidden');
                preview.innerHTML = '';
            }
        } else if (type === 'button') {
            const textVal = block.querySelector('.block-btn-text').value || 'Click Here';
            const btnEl = block.querySelector('.block-button-element');
            if (btnEl) {
                btnEl.textContent = textVal;
            }
        } else if (type === 'columns') {
            // Update individual slot previews
            block.querySelectorAll('.block-column-slot').forEach(slot => {
                const imgInput = slot.querySelector('.block-image-url');
                const videoInput = slot.querySelector('.block-video-url');
                const preview = slot.querySelector('.block-media-preview');
                
                if (imgInput) {
                    const img = preview.querySelector('img');
                    if (imgInput.value) {
                        img.src = imgInput.value;
                        preview.classList.remove('hidden');
                    } else {
                        preview.classList.add('hidden');
                    }
                }
                if (videoInput) {
                    if (videoInput.value) {
                        preview.innerHTML = getEmbedIframe(videoInput.value);
                        preview.classList.remove('hidden');
                    } else {
                        preview.classList.add('hidden');
                        preview.innerHTML = '';
                    }
                }
            });
        }
    }
    
    // Helper to generate embedded video HTML
    function getEmbedIframe(source) {
        if (source.includes('<iframe')) {
            return source; // Raw embed HTML
        }
        let embedUrl = source;
        if (source.includes('youtube.com/watch?v=')) {
            const videoId = source.split('v=')[1].split('&')[0];
            embedUrl = `https://www.youtube.com/embed/${videoId}`;
        } else if (source.includes('youtu.be/')) {
            const videoId = source.split('youtu.be/')[1].split('?')[0];
            embedUrl = `https://www.youtube.com/embed/${videoId}`;
        }
        return `<iframe class="w-full h-full" src="${embedUrl}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
    }
    
    // Compile all blocks to HTML string
    function compileBlocksToHTML() {
        let compiledHTML = '';
        const blocks = container.querySelectorAll('.block-item');
        
        blocks.forEach(block => {
            const type = block.dataset.type;
            
            // Read from text inputs (always synced by onPickerChange / syncColorInput)
            const colorTextInput = block.querySelector('.block-color-text');
            const color = colorTextInput ? (colorTextInput.value.trim() || '#1e293b') : '#1e293b';

            const bgTextInput = block.querySelector('.block-bgcolor-text');
            let bgColor = 'transparent';
            if (bgTextInput) {
                bgColor = bgTextInput.value.trim() || 'transparent';
            }
            const size = block.querySelector('.block-size') ? block.querySelector('.block-size').value : '16px';
            const align = block.querySelector('.block-align') ? block.querySelector('.block-align').value : 'center';
            const weight = block.querySelector('.block-weight') ? block.querySelector('.block-weight').value : '400';
            const lineHeight = block.querySelector('.block-lineheight') ? block.querySelector('.block-lineheight').value : '1.5';
            const padding = getPaddingValue(block);
            const radius = block.querySelector('.block-radius') ? block.querySelector('.block-radius').value : '6px';
            
            const isBold = block.querySelector('.format-bold') && block.querySelector('.format-bold').classList.contains('format-btn-active');
            const isItalic = block.querySelector('.format-italic') && block.querySelector('.format-italic').classList.contains('format-btn-active');
            const isUnderline = block.querySelector('.format-underline') && block.querySelector('.format-underline').classList.contains('format-btn-active');
            
            // Build style strings
            let styleAttr = `style="color: ${color}; font-size: ${size}; text-align: ${align}; line-height: ${lineHeight};`;
            if (bgColor !== 'transparent') styleAttr += ` background-color: ${bgColor};`;
            if (padding !== '0px') styleAttr += ` padding: ${padding};`;
            if (radius !== '0px') styleAttr += ` border-radius: ${radius};`;
            
            if (isBold) {
                styleAttr += ' font-weight: bold;';
            } else if (weight !== '400') {
                styleAttr += ` font-weight: ${weight};`;
            }
            if (isItalic) styleAttr += ' font-style: italic;';
            if (isUnderline) styleAttr += ' text-decoration: underline;';
            styleAttr += '"';
            
            if (type === 'paragraph') {
                const text = block.querySelector('.block-input').value;
                if (text.trim()) {
                    compiledHTML += `<p ${styleAttr}>${escapeHTML(text)}</p>\n`;
                }
            } else if (type === 'heading') {
                const level = block.querySelector('.block-heading-level').value;
                const text = block.querySelector('.block-input').value;
                if (text.trim()) {
                    compiledHTML += `<${level} ${styleAttr}>${escapeHTML(text)}</${level}>\n`;
                }
            } else if (type === 'quote') {
                const text = block.querySelector('.block-input').value;
                const cite = block.querySelector('.block-quote-cite').value;
                const borderColor = block.querySelector('.block-border-color').value;
                if (text.trim()) {
                    compiledHTML += `<blockquote data-wp-block="quote" data-cite="${escapeHTML(cite)}" data-border-color="${borderColor}" style="border-left: 4px solid ${borderColor}; padding-left: 16px; margin: 24px 0; color: ${color}; background-color: ${bgColor}; font-size: ${size}; font-style: italic;">\n  <p>${escapeHTML(text)}</p>\n  <cite style="display: block; font-size: 0.85em; margin-top: 8px; font-style: normal; font-weight: normal; opacity: 0.85;">${escapeHTML(cite)}</cite>\n</blockquote>\n`;
                }
            } else if (type === 'list') {
                const itemsText = block.querySelector('.block-input').value;
                const listStyle = block.querySelector('.block-list-style').value;
                const listTag = listStyle === 'ol' ? 'ol' : 'ul';
                
                if (itemsText.trim()) {
                    const items = itemsText.split('\n').filter(i => i.trim());
                    let listItemsHTML = '';
                    items.forEach(item => {
                        listItemsHTML += `  <li style="margin-bottom: 4px;">${escapeHTML(item)}</li>\n`;
                    });
                    
                    let listStyleAttr = `style="color: ${color}; font-size: ${size}; line-height: ${lineHeight}; margin-left: 24px; list-style-type: ${listStyle === 'ol' ? 'decimal' : 'disc'};"`;
                    compiledHTML += `<${listTag} data-wp-block="list" data-list-style="${listStyle}" ${listStyleAttr}>\n${listItemsHTML}</${listTag}>\n`;
                }
            } else if (type === 'button') {
                const btnText = block.querySelector('.block-btn-text').value || 'Click Here';
                const btnLink = block.querySelector('.block-btn-link').value || '#';
                const buttonColorVal = block.querySelector('.block-bgcolor') ? block.querySelector('.block-bgcolor').value : '#2271b1';
                const buttonTextColorVal = block.querySelector('.block-color') ? block.querySelector('.block-color').value : '#ffffff';
                
                let buttonStyle = `style="display: inline-block; padding: 10px 22px; background-color: ${buttonColorVal}; color: ${buttonTextColorVal}; border-radius: ${radius}; text-decoration: none; font-weight: bold; font-size: ${size}; box-shadow: 0 1px 2px rgba(0,0,0,0.05);"`;
                compiledHTML += `<div data-wp-block="button" data-link="${escapeHTML(btnLink)}" style="text-align: ${align}; margin: 20px 0;">\n  <a href="${escapeHTML(btnLink)}" ${buttonStyle}>${escapeHTML(btnText)}</a>\n</div>\n`;
            } else if (type === 'divider') {
                const lineStyle = block.querySelector('.block-divider-style').value;
                const thickness = block.querySelector('.block-divider-thickness').value;
                compiledHTML += `<hr data-wp-block="divider" data-line-style="${lineStyle}" data-thickness="${thickness}" data-color="${color}" style="border: 0; border-top: ${thickness} ${lineStyle} ${color}; margin: 24px 0;">\n`;
            } else if (type === 'image') {
                const url = block.querySelector('.block-image-url').value;
                const alt = block.querySelector('.block-image-alt').value;
                
                let imgStyles = `style="border-radius: ${radius};`;
                if (align === 'left') {
                    imgStyles += ' margin-right: auto; margin-left: 0; display: block;';
                } else if (align === 'right') {
                    imgStyles += ' margin-left: auto; margin-right: 0; display: block;';
                } else {
                    imgStyles += ' margin-left: auto; margin-right: auto; display: block;';
                }
                imgStyles += '"';
                
                if (url.trim()) {
                    compiledHTML += `<figure class="my-6 text-center"><img src="${url}" alt="${escapeHTML(alt)}" class="rounded max-w-full" ${imgStyles}></figure>\n`;
                }
            } else if (type === 'video') {
                const url = block.querySelector('.block-video-url').value;
                let videoStyles = `style="border-radius: ${radius};`;
                if (align === 'left') {
                    videoStyles += ' margin-right: auto; margin-left: 0;';
                } else if (align === 'right') {
                    videoStyles += ' margin-left: auto; margin-right: 0;';
                } else {
                    videoStyles += ' margin-left: auto; margin-right: auto;';
                }
                videoStyles += '"';
                
                if (url.trim()) {
                    compiledHTML += `<div class="aspect-video max-w-2xl my-6 rounded overflow-hidden shadow-md" ${videoStyles}>${getEmbedIframe(url)}</div>\n`;
                }
            } else if (type === 'columns') {
                const colCount = parseInt(block.querySelector('.block-layout').value);
                const ratio = block.querySelector('.block-ratio').value.trim() || Array(colCount).fill('1fr').join(' ');
                
                let sectionStyles = `style="display: grid; gap: 24px; align-items: start; grid-template-columns: ${ratio};`;
                if (bgColor !== 'transparent') sectionStyles += ` background-color: ${bgColor};`;
                if (padding !== '0px') sectionStyles += ` padding: ${padding};`;
                if (radius !== '0px') sectionStyles += ` border-radius: ${radius};`;
                sectionStyles += '"';
                
                let columnsHTML = '';
                for (let i = 1; i <= colCount; i++) {
                    const slot = block.querySelector(`.block-column-slot[data-index="${i}"]`);
                    const slotType = slot.querySelector('.block-slot-type').value;
                    
                    if (slotType === 'empty') {
                        columnsHTML += `    <div class="wp-column-slot" data-slot-type="empty"></div>\n`;
                        continue;
                    }
                    
                    const colorTextInput = slot.querySelector('.slot-color-text');
                    const color = colorTextInput ? (colorTextInput.value.trim() || '#1e293b') : '#1e293b';
                    
                    const bgTextInput = slot.querySelector('.slot-bgcolor-text');
                    const bgColorVal = bgTextInput ? (bgTextInput.value.trim() || 'transparent') : 'transparent';
                    
                    const padTop = slot.querySelector('.slot-padding-top') ? (slot.querySelector('.slot-padding-top').value.trim() || '0px') : '0px';
                    const padRight = slot.querySelector('.slot-padding-right') ? (slot.querySelector('.slot-padding-right').value.trim() || '0px') : '0px';
                    const padBottom = slot.querySelector('.slot-padding-bottom') ? (slot.querySelector('.slot-padding-bottom').value.trim() || '0px') : '0px';
                    const padLeft = slot.querySelector('.slot-padding-left') ? (slot.querySelector('.slot-padding-left').value.trim() || '0px') : '0px';
                    const slotPadding = `${formatPaddingUnit(padTop)} ${formatPaddingUnit(padRight)} ${formatPaddingUnit(padBottom)} ${formatPaddingUnit(padLeft)}`;
                    
                    const radiusVal = slot.querySelector('.slot-radius') ? slot.querySelector('.slot-radius').value : '0px';
                    
                    let slotStyleAttr = `style="background-color: ${bgColorVal}; padding: ${slotPadding}; border-radius: ${radiusVal};"`;
                    
                    let textStylesAttr = '';
                    let size = '14px';
                    let align = 'left';
                    let weight = '400';
                    let lineHeight = '1.5';
                    let isBold = false, isItalic = false, isUnderline = false;
                    
                    if (slotType === 'text') {
                        size = slot.querySelector('.slot-size') ? slot.querySelector('.slot-size').value : '14px';
                        align = slot.querySelector('.slot-align') ? slot.querySelector('.slot-align').value : 'left';
                        weight = slot.querySelector('.slot-weight') ? slot.querySelector('.slot-weight').value : '400';
                        lineHeight = slot.querySelector('.slot-lineheight') ? slot.querySelector('.slot-lineheight').value : '1.5';
                        
                        isBold = slot.querySelector('.slot-format-bold') && slot.querySelector('.slot-format-bold').classList.contains('format-btn-active');
                        isItalic = slot.querySelector('.slot-format-italic') && slot.querySelector('.slot-format-italic').classList.contains('format-btn-active');
                        isUnderline = slot.querySelector('.slot-format-underline') && slot.querySelector('.slot-format-underline').classList.contains('format-btn-active');
                        
                        textStylesAttr = `style="color: ${color}; font-size: ${size}; text-align: ${align}; line-height: ${lineHeight}; font-weight: ${isBold ? 'bold' : weight}; font-style: ${isItalic ? 'italic' : 'normal'}; text-decoration: ${isUnderline ? 'underline' : 'none'};"`;
                    }
                    
                    columnsHTML += `    <div class="wp-column-slot" data-slot-type="${slotType}" data-color="${color}" data-bg-color="${bgColorVal}" data-font-size="${size}" data-text-align="${align}" data-font-weight="${weight}" data-line-height="${lineHeight}" data-padding="${slotPadding}" data-border-radius="${radiusVal}" data-bold="${isBold}" data-italic="${isItalic}" data-underline="${isUnderline}" ${slotStyleAttr}>\n`;
                    
                    if (slotType === 'text') {
                        const headingEl = slot.querySelector('.block-input-heading');
                        const bodyEl = slot.querySelector('.block-input');
                        const heading = headingEl ? headingEl.value.trim() : '';
                        const pText = bodyEl ? bodyEl.value.trim() : '';
                        if (heading) columnsHTML += `        <h3 ${textStylesAttr}>${escapeHTML(heading)}</h3>\n`;
                        if (pText) columnsHTML += `        <p ${textStylesAttr}>${escapeHTML(pText)}</p>\n`;
                    } else if (slotType === 'image') {
                        const imgUrl = slot.querySelector('.block-image-url').value.trim();
                        const imgAlt = slot.querySelector('.block-image-alt').value.trim();
                        if (imgUrl) columnsHTML += `        <img src="${imgUrl}" alt="${escapeHTML(imgAlt)}" class="rounded max-w-full mx-auto" style="border-radius: ${radiusVal};">\n`;
                    } else if (slotType === 'video') {
                        const videoUrl = slot.querySelector('.block-video-url').value.trim();
                        if (videoUrl) columnsHTML += `        <div class="aspect-video rounded overflow-hidden bg-black" style="border-radius: ${radiusVal};">${getEmbedIframe(videoUrl)}</div>\n`;
                    }
                    columnsHTML += `    </div>\n`;
                }
                
                compiledHTML += `<div class="wp-columns-grid my-8" data-wp-block="columns" data-columns="${colCount}" data-ratio="${ratio}" ${sectionStyles}>\n${columnsHTML}</div>\n`;
            }
        });
        
        return compiledHTML;
    }
    
    function escapeHTML(str) {
        return str.replace(/[&<>'"]/g, 
            tag => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                "'": '&#39;',
                '"': '&quot;'
            }[tag] || tag)
        );
    }
    
    // Parse HTML back into Blocks (when editing)
    function parseHTMLToBlocks(htmlContent) {
        if (!htmlContent) {
            // Default: Start with 1 Paragraph block
            addBlock('paragraph');
            return;
        }
        
        const parser = new DOMParser();
        const doc = parser.parseFromString(htmlContent, 'text/html');
        const nodes = doc.body.childNodes;
        let blocksAdded = 0;
        
        nodes.forEach(node => {
            if (node.nodeType === Node.TEXT_NODE && !node.textContent.trim()) return;
            
            let type = '';
            let content = '';
            let styles = {};
            
            // Extract standard inline styles from node
            if (node.style) {
                if (node.style.color) styles.color = rgbToHex(node.style.color);
                if (node.style.backgroundColor) styles.bgColor = rgbToHex(node.style.backgroundColor);
                if (node.style.fontSize) styles.fontSize = node.style.fontSize;
                if (node.style.fontWeight === 'bold') {
                    styles.bold = true;
                } else if (node.style.fontWeight) {
                    styles.fontWeight = node.style.fontWeight;
                }
                if (node.style.textAlign) styles.textAlign = node.style.textAlign;
                if (node.style.lineHeight) styles.lineHeight = node.style.lineHeight;
                if (node.style.padding) styles.padding = node.style.padding;
                if (node.style.borderRadius) styles.borderRadius = node.style.borderRadius;
                if (node.style.fontStyle === 'italic') styles.italic = true;
                if (node.style.textDecoration && node.style.textDecoration.includes('underline')) styles.underline = true;
            }
            
            const nodeName = node.nodeName.toLowerCase();
            
            if (nodeName === 'blockquote' && node.dataset.wpBlock === 'quote') {
                type = 'quote';
                const p = node.querySelector('p');
                content = p ? p.innerText : '';
                styles.cite = node.dataset.cite || '';
                styles.borderColor = node.dataset.borderColor || '#2271b1';
            } else if ((nodeName === 'ul' || nodeName === 'ol') && node.dataset.wpBlock === 'list') {
                type = 'list';
                styles.listStyle = node.dataset.listStyle || nodeName;
                const items = Array.from(node.querySelectorAll('li'));
                content = items.map(li => li.innerText).join('\n');
            } else if (nodeName === 'div' && node.dataset.wpBlock === 'button') {
                type = 'button';
                const a = node.querySelector('a');
                content = a ? a.innerText : 'Click Here';
                styles.link = node.dataset.link || (a ? a.getAttribute('href') : '#');
                if (a && a.style) {
                    if (a.style.backgroundColor) styles.bgColor = rgbToHex(a.style.backgroundColor);
                    if (a.style.color) styles.color = rgbToHex(a.style.color);
                    if (a.style.borderRadius) styles.borderRadius = a.style.borderRadius;
                    if (a.style.fontSize) styles.fontSize = a.style.fontSize;
                }
            } else if (nodeName === 'hr' && node.dataset.wpBlock === 'divider') {
                type = 'divider';
                styles.borderStyle = node.dataset.lineStyle || 'solid';
                styles.thickness = node.dataset.thickness || '1px';
                styles.color = node.dataset.color || rgbToHex(node.style.borderTopColor) || '#cbd5e1';
            } else if (nodeName === 'p') {
                type = 'paragraph';
                content = node.innerText || node.textContent;
            } else if (['h2', 'h3', 'h4'].includes(nodeName)) {
                type = 'heading';
                content = node.innerText || node.textContent;
                styles.level = nodeName;
            } else if (nodeName === 'figure' || nodeName === 'img') {
                type = 'image';
                const img = nodeName === 'img' ? node : node.querySelector('img');
                if (img) {
                    content = img.getAttribute('src') || '';
                    styles.alt = img.getAttribute('alt') || '';
                    if (img.style && img.style.borderRadius) styles.borderRadius = img.style.borderRadius;
                    if (img.style) {
                        if (img.style.marginLeft === '0px' || img.style.marginLeft === '0') {
                            styles.textAlign = 'left';
                        } else if (img.style.marginRight === '0px' || img.style.marginRight === '0') {
                            styles.textAlign = 'right';
                        } else {
                            styles.textAlign = 'center';
                        }
                    }
                }
            } else if (nodeName === 'div' && node.dataset.wpBlock === 'columns') {
                type = 'columns';
                const colCount = parseInt(node.dataset.columns) || Array.from(node.children).length || 2;
                styles.layout = String(colCount);
                styles.ratio = node.dataset.ratio || Array(colCount).fill('1fr').join(' ');
                
                const columnChildren = Array.from(node.children);
                
                for (let i = 0; i < 5; i++) {
                    const idx = i + 1;
                    if (i < columnChildren.length) {
                        const colNode = columnChildren[i];
                        styles[`col${idx}Type`] = colNode.dataset.slotType || 'empty';
                        
                        styles[`col${idx}Color`] = colNode.dataset.color || '#1e293b';
                        styles[`col${idx}BgColor`] = colNode.dataset.bgColor || 'transparent';
                        styles[`col${idx}FontSize`] = colNode.dataset.fontSize || '14px';
                        styles[`col${idx}TextAlign`] = colNode.dataset.textAlign || 'left';
                        styles[`col${idx}FontWeight`] = colNode.dataset.fontWeight || '400';
                        styles[`col${idx}LineHeight`] = colNode.dataset.lineHeight || '1.5';
                        styles[`col${idx}Padding`] = colNode.dataset.padding || '0px';
                        styles[`col${idx}BorderRadius`] = colNode.dataset.borderRadius || '0px';
                        styles[`col${idx}Bold`] = colNode.dataset.bold === 'true';
                        styles[`col${idx}Italic`] = colNode.dataset.italic === 'true';
                        styles[`col${idx}Underline`] = colNode.dataset.underline === 'true';
                        
                        const typeVal = styles[`col${idx}Type`];
                        
                        if (typeVal === 'text') {
                            const h3 = colNode.querySelector('h3');
                            const p = colNode.querySelector('p');
                            const headingText = h3 ? h3.innerText : '';
                            const pText = p ? p.innerText : '';
                            styles[`col${idx}Text`] = headingText ? `${headingText} ### ${pText}` : pText;
                        } else if (typeVal === 'image') {
                            const img = colNode.querySelector('img');
                            styles[`col${idx}ImgUrl`] = img ? img.getAttribute('src') : '';
                            styles[`col${idx}ImgAlt`] = img ? img.getAttribute('alt') : '';
                        } else if (typeVal === 'video') {
                            const iframe = colNode.querySelector('iframe') || colNode.querySelector('video');
                            styles[`col${idx}ImgUrl`] = iframe ? iframe.getAttribute('src') || iframe.outerHTML : '';
                        }
                    } else {
                        styles[`col${idx}Type`] = 'empty';
                    }
                }
            } else if (nodeName === 'div' && (node.querySelector('iframe') || node.querySelector('video'))) {
                type = 'video';
                const media = node.querySelector('iframe') || node.querySelector('video');
                content = media.outerHTML; // Keep embed html
                if (node.style && node.style.borderRadius) styles.borderRadius = node.style.borderRadius;
                if (node.style) {
                    if (node.style.marginLeft === '0px' || node.style.marginLeft === '0') {
                        styles.textAlign = 'left';
                    } else if (node.style.marginRight === '0px' || node.style.marginRight === '0') {
                        styles.textAlign = 'right';
                    } else {
                        styles.textAlign = 'center';
                    }
                }
            } else {
                type = 'paragraph';
                content = node.innerText || node.textContent || '';
            }
            
            if (type && (content.trim() || type === 'image' || type === 'video' || type === 'columns' || type === 'divider' || type === 'button')) {
                addBlock(type, content, styles);
                blocksAdded++;
            }
        });
        
        if (blocksAdded === 0) {
            addBlock('paragraph');
        }
    }
    
    // Convert rgb() colors back to Hex for picker
    function rgbToHex(rgb) {
        if (!rgb || !rgb.startsWith('rgb')) return rgb;
        const matches = rgb.match(/\d+/g);
        if (!matches || matches.length < 3) return rgb;
        return "#" + ((1 << 24) + (parseInt(matches[0]) << 16) + (parseInt(matches[1]) << 8) + parseInt(matches[2])).toString(16).slice(1);
    }
    
    // Bind form submit
    form.onsubmit = function(e) {
        hiddenContentInput.value = compileBlocksToHTML();
    };

    // Load initial content
    document.addEventListener('DOMContentLoaded', () => {
        const initialHTML = @json(old('content') ?? $editblog['description'] ?? '');
        parseHTMLToBlocks(initialHTML);
    });

    // Thumbnail tab switcher
    function switchThumbTab(mode) {
        const uploadPane = document.getElementById('thumb-pane-upload');
        const urlPane = document.getElementById('thumb-pane-url');
        const uploadTab = document.getElementById('thumb-tab-upload');
        const urlTab = document.getElementById('thumb-tab-url');

        if (mode === 'upload') {
            uploadPane.classList.remove('hidden');
            urlPane.classList.add('hidden');
            uploadTab.classList.add('active');
            urlTab.classList.remove('active');
            // Clear URL input so it doesn't submit
            document.getElementById('thumbnailUrl').value = '';
        } else {
            uploadPane.classList.add('hidden');
            urlPane.classList.remove('hidden');
            uploadTab.classList.remove('active');
            urlTab.classList.add('active');
        }
    }

    function handleThumbUrlPreview(url) {
        if (url && url.startsWith('http')) {
            handlePreview(url);
        } else if (!url) {
            if (currentPreview) { currentPreview.remove(); currentPreview = null; }
        }
    }

    // Image preview handler
    const thumbnailInput = document.getElementById('thumbnailImage');
    let currentPreview = null;

    function handlePreview(src) {
        if (currentPreview) {
            currentPreview.remove();
        }
        currentPreview = document.createElement('div');
        currentPreview.className = 'relative w-full max-w-[280px] h-[160px] rounded overflow-hidden border border-slate-200 dark:border-slate-800 bg-slate-100 dark:bg-slate-950 mt-3 animate-fadeIn';
        currentPreview.innerHTML = `<img src="${src}" class="w-full h-full object-cover" alt="Preview">`;
        // Append below whichever pane is active
        const activePane = document.getElementById('thumb-pane-url').classList.contains('hidden')
            ? document.getElementById('thumb-pane-upload')
            : document.getElementById('thumb-pane-url');
        activePane.appendChild(currentPreview);
    }

    thumbnailInput.addEventListener('change', function(e) {
        const fileNamespan = document.getElementById('thumbnailFileName');
        if (e.target.files.length > 0) {
            if (fileNamespan) fileNamespan.textContent = e.target.files[0].name;
            handlePreview(URL.createObjectURL(e.target.files[0]));
        } else {
            if (fileNamespan) fileNamespan.textContent = 'No file chosen';
        }
    });

    @if(isset($editblog['thumbnail']))
        @php $thumb = $editblog['thumbnail']; @endphp
        @if(str_starts_with($thumb, 'http'))
            {{-- External URL thumbnail --}}
            handlePreview("{{ $thumb }}");
            switchThumbTab('url');
            document.getElementById('thumbnailUrl').value = "{{ $thumb }}";
        @else
            {{-- Storage path thumbnail --}}
            handlePreview("{{ asset('storage/' . $thumb) }}");
            document.addEventListener('DOMContentLoaded', () => {
                const fileNamespan = document.getElementById('thumbnailFileName');
                if (fileNamespan) fileNamespan.textContent = "{{ basename($thumb) }}";
            });
        @endif
    @endif
</script>
@endsection
