@extends('layouts.main_layout')
@section('content')

<div class="min-h-screen flex items-center justify-center p-8">
    <div class="bg-tn-bg border-[3px] border-tn-dark shadow-[10px_10px_0_#131313] px-11 py-12 max-w-xl w-full text-center flex flex-col items-center gap-5">
        <span class="text-5xl text-tn-red">⚠</span>
        <h3 class="font-heading text-3xl">{{ $note->title }}</h3>
        <p class="text-tn-dark/70 text-lg">Are you sure you want to delete this note?</p>
        <div class="flex gap-4 mt-2.5">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2.5 rounded-full font-bold text-lg tracking-wide px-7 py-4 font-sans border-2 border-tn-dark text-tn-dark hover:bg-tn-dark hover:text-tn-bg transition-colors">No</a>
            <a href="{{ route('deleteNoteConfirm', ['id' => Crypt::encrypt($note->id)]) }}" class="inline-flex items-center justify-center gap-2.5 rounded-full font-bold text-lg tracking-wide px-7 py-4 font-sans bg-tn-red text-tn-bg hover:bg-tn-red-hover transition-colors">Yes, delete</a>
        </div>
    </div>
</div>

@endsection
