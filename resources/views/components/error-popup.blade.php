<div id="errorPopupContainer" class="translate-x-[150%] fixed top-6 right-6 shadow-2xl z-50 transition-all ease-in-out duration-350 max-w-sm w-full">
    @if ($errors->any() || session('error') || !empty($successMessage))
        <div id="errorPopup" class="relative overflow-hidden rounded-2xl border backdrop-blur-lg shadow-2xl text-slate-100 flex items-stretch">
            @if ($errors->any() || session('error'))
                <div class="bg-rose-950/90 border-rose-800/80 px-4 py-4 w-full flex items-start gap-3">
                    <div class="text-rose-400 mt-0.5"><i class="fa-solid fa-circle-exclamation text-xl"></i></div>
                    <div class="flex-grow text-sm font-medium">
                        <div class="font-bold text-rose-200 mb-0.5">Error Occurred</div>
                        @if (session('error'))
                            <span class="block text-rose-300/90">{{ session('error') }}</span>
                        @endif
                        @if ($errors->any())
                            @foreach ($errors->all() as $message)
                                <span class="block text-rose-300/90">{{ $message }}</span>
                            @endforeach
                        @endif
                    </div>
                    <button class="error-popup-close text-rose-400 hover:text-rose-200 transition-colors p-1 -mt-1 -mr-1">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
                <div id="progressBar" class="absolute bottom-0 left-0 h-1 w-full bg-rose-500 ease-linear"></div>
            @endif

            @if (!empty($successMessage))
                <div class="bg-emerald-950/90 border-emerald-800/80 px-4 py-4 w-full flex items-start gap-3">
                    <div class="text-emerald-400 mt-0.5"><i class="fa-solid fa-circle-check text-xl"></i></div>
                    <div class="flex-grow text-sm font-medium">
                        <div class="font-bold text-emerald-200 mb-0.5">Success</div>
                        <span class="text-emerald-300/90">{{ $successMessage }}</span>
                    </div>
                    <button class="error-popup-close text-emerald-400 hover:text-emerald-200 transition-colors p-1 -mt-1 -mr-1">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
                <div id="progressBar" class="absolute bottom-0 left-0 h-1 w-full bg-emerald-500 ease-linear"></div>
            @endif
        </div>
    @endif
</div>
