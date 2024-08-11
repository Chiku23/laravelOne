<footer class="bg-indigo-950">
    <div class="min-h-24 text-center w-full">
        <div class="pt-4">Developed By Chiku . CopyRight©2024</div>
    </div>
</footer>
<!-- Logout form -->
<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
    @csrf
</form>