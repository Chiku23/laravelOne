<div id="errorPopupContainer" class="translate-x-[150%] fixed top-10 right-5 shadow-lg z-50 transition-all ease-in-out duration-150">
    @if ($errors->any() || !empty($successMessage))
        <div id="errorPopup" class="text-white relative">
            @if ($errors->any())
                <div class="bg-red-500 px-4 py-2 rounded">
                    @foreach ($errors->all() as $message)
                        <span class="text-white">{{ $message }}</span><br>
                    @endforeach
                </div>
            @endif

            @if (!empty($successMessage))
                <div class="bg-green-500 px-4 py-2 rounded">
                    <span class="text-white">{{ $successMessage }}</span>
                </div>
            @endif
        </div>
        <div id="progressBar" class="absolute bottom-0 left-0 h-1 duration-[3s] transition-[width] w-full bg-white ease-linear"></div>
    @endif
</div>
