<div>
    @if($confirmedAt !== null)
        <div class="p-2 bg-green-100 rounded border border-green-400">
            <x-icon name="check" class="w-5 h-5 inline"/> Opłacone
        </div>
    @elseif($cancelledAt !== null)
        <div class="p-2 bg-red-100 rounded border border-red-400">
            <x-icon name="x-circle" class="w-5 h-5 inline"/> Odrzucone
        </div>
    @else
        <div class="p-2 bg-blue-100 rounded border border-blue-400">
            <x-icon name="refresh" class="w-5 h-5 inline"/> Oczekuje
        </div>
    @endif
</div>
