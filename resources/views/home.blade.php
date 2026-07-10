@extends('layouts.main_layout')
@section('content')

<div class="min-h-screen flex flex-col">

    @include('top_bar')

    <div class="w-full px-12 py-8 pb-14 flex flex-col gap-9">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <h1 class="font-heading text-5xl">Your notes</h1>
            <a href="{{ route('new') }}" class="inline-flex items-center justify-center gap-2.5 rounded-full font-bold text-lg tracking-wide px-7 py-4 font-sans uppercase bg-tn-yellow text-tn-dark hover:bg-tn-yellow-hover transition-colors">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M12 5v14M5 12h14"/></svg>
                New note
            </a>
        </div>

        @if(count($notes) == 0)
        <div class="border-2 border-dashed border-tn-dark px-8 py-20 flex flex-col items-center gap-6 text-center">
            <span class="text-5xl text-tn-orange">✦</span>
            <p class="font-heading text-3xl">No notes here yet</p>
            <a href="{{ route('new') }}" class="inline-flex items-center justify-center gap-2.5 rounded-full font-bold text-lg tracking-wide px-7 py-4 font-sans uppercase bg-tn-yellow text-tn-dark hover:bg-tn-yellow-hover transition-colors">Create your first note</a>
        </div>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($notes as $note)
                @include('note')
            @endforeach
        </div>
        @endif
    </div>

</div>
@endsection
