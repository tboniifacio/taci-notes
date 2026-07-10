<div class="bg-tn-green border-2 border-tn-dark p-7 flex flex-col gap-4">
    <div class="flex justify-between items-start gap-3">
        <h3 class="font-sans font-bold text-2xl text-tn-bg break-words">{{ $note->title }}</h3>
        <div class="flex gap-2 shrink-0">
            <a href="{{ route('edit', ['id' => Crypt::encrypt($note->id)]) }}" title="Edit" class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 bg-tn-yellow text-tn-dark hover:bg-tn-yellow-hover transition-colors">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
            </a>
            <a href="{{ route('deleteNote', ['id' => Crypt::encrypt($note->id)]) }}" title="Delete" class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 bg-tn-red text-tn-bg hover:bg-tn-red-hover transition-colors">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
            </a>
        </div>
    </div>
    <div>
        <span class="inline-block bg-tn-dark text-tn-bg text-sm font-semibold tracking-wide uppercase rounded-full px-3.5 py-1.5">Created on {{ date('m/d/Y', strtotime($note->created_at)) }}</span>
        @if ($note['created_at'] != $note['updated_at'])
        <span class="inline-block ml-1.5 bg-tn-dark text-tn-bg text-sm font-semibold tracking-wide uppercase rounded-full px-3.5 py-1.5">Updated on {{ date('m/d/Y', strtotime($note->updated_at)) }}</span>
        @endif
    </div>
    <p class="text-tn-bg/85 text-lg leading-normal whitespace-pre-wrap">{{ $note->text }}</p>
</div>
