<div class="w-full bg-tn-green px-12 py-7 flex items-center justify-between gap-6 flex-wrap border-b-2 border-tn-dark">
    <a href="{{ route('home') }}">
        <img src="{{ asset('assets/images/taci-logo.svg') }}" alt="Taci Notes" class="h-10">
    </a>
    <div class="text-lg text-tn-bg/90">A simple <span class="text-tn-yellow font-semibold">Laravel</span> project!</div>
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-2.5 text-lg text-tn-bg">
            <span class="w-9 h-9 rounded-full bg-tn-yellow text-tn-dark flex items-center justify-center font-bold text-base">{{ strtoupper(substr(session('user.username'), 0, 1)) }}</span>
            {{ session('user.username') }}
        </div>
        <a href="{{ route('logout') }}" class="inline-flex items-center justify-center gap-2.5 rounded-full font-bold text-lg tracking-wide px-7 py-4 font-sans border-2 border-tn-bg text-tn-bg hover:bg-tn-dark hover:border-tn-dark transition-colors">
            Log out
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/></svg>
        </a>
    </div>
</div>
