<div id="errorPopupContainer" class="translate-x-[150%] fixed top-10 right-5 shadow-lg z-50 transition-all ease-in-out duration-150">
    @if (!empty($errors->any()) || !empty($successMessage))

        <div id="errorPopup" class="{{ $errors->any() ? 'bg-red-500' : ($successMessage ? 'bg-green-500' : '') }} text-white px-4 py-2 rounded relative">
            @if ($errors->any())
                <span class="error-popup-close cursor-pointer bg-red-900 rounded-full inline-flex flex-wrap">
                    <i class="fa-solid fa-xmark h-4 w-4 m-2 justify-center flex items-center text-xl"></i>
                </span>
                <span class="text-white">@foreach ($errors->all() as $message) {{ $message }} @endforeach</span>
            @endif
            @if ($successMessage)
                <span class="text-white">{{ $successMessage }}</span>
            @endif
            <div id="progressBar" class="absolute bottom-0 left-0 h-1 duration-[3s] transition-[width] w-full bg-white ease-linear"></div>
        </div>
    @endif
</div>
