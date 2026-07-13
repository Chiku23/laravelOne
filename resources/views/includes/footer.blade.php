<footer class="bg-slate-950/85 border-t border-slate-900 mt-auto">
    <div class="max-w-1200 mx-auto px-4 py-8 text-center text-slate-500 text-sm">
        <div>Developed By <span class="text-indigo-400 font-semibold">Chiku</span> &bull; CopyRight &copy; {{ date('Y') }}</div>
        <div class="mt-1 text-xs text-slate-600">Thought Threads &mdash; A Modern Space for Sharing Ideas</div>
    </div>
</footer>
<!-- Logout form -->
<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
    @csrf
</form>