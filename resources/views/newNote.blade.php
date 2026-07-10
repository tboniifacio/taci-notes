@extends('layouts.main_layout')
@section('content')

<div class="min-h-screen flex flex-col">

    @include('top_bar')

    <div class="max-w-4xl mx-auto w-full px-8 py-14 flex flex-col gap-7">
        <div class="flex items-center justify-between">
            <h1 class="font-heading text-4xl">New note</h1>
            <a href="{{ route('home') }}" class="w-12 h-12 rounded-full border-2 border-tn-dark flex items-center justify-center text-tn-dark hover:bg-tn-dark hover:text-tn-bg transition-colors">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M18 6L6 18M6 6l12 12"/></svg>
            </a>
        </div>

        <form action="{{ route('newNoteSubmit') }}" method="post" class="flex flex-col gap-6">
            @csrf

            <div class="flex flex-col gap-2">
                <label class="text-base font-semibold tracking-wide uppercase text-tn-dark">Note title</label>
                <input type="text" class="border-2 border-tn-dark bg-white px-5 py-4 font-sans text-lg text-tn-dark outline-none w-full" name="text_title" placeholder="e.g. Shopping list">
                @error('text_title')
                <div class="text-tn-red text-base">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-base font-semibold tracking-wide uppercase text-tn-dark">Content</label>
                <textarea class="border-2 border-tn-dark bg-white px-5 py-4 font-sans text-lg text-tn-dark outline-none w-full resize-y" name="text_note" rows="7" placeholder="Write your note here..."></textarea>
                @error('text_note')
                <div class="text-tn-red text-base">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end gap-4 mt-1.5">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2.5 rounded-full font-bold text-lg tracking-wide px-7 py-4 font-sans border-2 border-tn-orange text-tn-orange hover:bg-tn-orange hover:text-tn-bg transition-colors">Cancel</a>
                <button type="submit" class="inline-flex items-center justify-center gap-2.5 rounded-full font-bold text-lg tracking-wide px-7 py-4 font-sans bg-tn-yellow text-tn-dark hover:bg-tn-yellow-hover transition-colors">Save</button>
            </div>
        </form>
    </div>

</div>
@endsection
