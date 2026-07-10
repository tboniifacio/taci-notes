@extends('layouts.main_layout')
@section('content')

<div class="min-h-screen flex items-center justify-center p-8">
    <div class="w-full max-w-xl border-[3px] border-tn-dark shadow-[10px_10px_0_#131313] bg-tn-bg">
        <div class="relative overflow-hidden bg-tn-green px-11 pt-14 pb-11 flex flex-col items-center gap-3.5">
            <span class="absolute top-4.5 left-6 text-2xl leading-none text-tn-yellow">✦</span>
            <span class="absolute bottom-6 right-7 text-lg leading-none text-tn-orange">✦</span>
            <img src="{{ asset('assets/images/taci-logo.svg') }}" alt="Taci Notes" class="h-11">
            <p class="mt-2 text-lg text-center text-tn-bg/85">A simple <span class="text-tn-yellow font-semibold">Laravel</span> project!</p>
        </div>
        <form action="/loginSubmit" method="post" novalidate class="p-11 flex flex-col gap-6">
            @csrf

            <div class="flex flex-col gap-2">
                <label for="text_username" class="text-base font-semibold tracking-wide uppercase text-tn-dark">Email</label>
                <input type="email" class="border-2 border-tn-dark bg-white px-5 py-4 font-sans text-lg text-tn-dark outline-none w-full" id="text_username" name="text_username" placeholder="you@email.com" value="{{ old('text_username') }}" required>
                @error('text_username')
                <div class="text-tn-red text-base">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col gap-2">
                <label for="text_password" class="text-base font-semibold tracking-wide uppercase text-tn-dark">Password</label>
                <input type="password" class="border-2 border-tn-dark bg-white px-5 py-4 font-sans text-lg text-tn-dark outline-none w-full" id="text_password" name="text_password" placeholder="••••••••" autocomplete="new-password" value="{{ old('text_password') }}" required>
                @error('text_password')
                <div class="text-tn-red text-base">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="mt-2 inline-flex items-center justify-center gap-2.5 rounded-full font-bold text-lg tracking-wide px-7 py-4 font-sans uppercase bg-tn-yellow text-tn-dark hover:bg-tn-yellow-hover transition-colors">Sign in</button>

            @if (session('loginError'))
            <div class="text-tn-red text-base text-center">
                {{ session('loginError') }}
            </div>
            @endif

        </form>
    </div>
</div>

@endsection
