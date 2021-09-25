<div class="flex space-x-1 justify-around content-center place-items-center">

    <a href="{{ route('payments.show', $id) }}" title="Edytuj"
       class="text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path
                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
        </svg>
    </a>

    @if(empty($confirmed_at))
        @include('datatables::delete', ['value' => $id])

        <a href="#" wire:click="sendEmail({{$id}})" class="text-green-600" title="Wyślij maila do klienta">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
            </svg>
        </a>

        <a href="#" wire:click="confirm({{ $id }})" class="text-purple-600" title="Potwierdź płatność ręcznie">
            <svg class="w-6 sm:w-5 h-6 sm:h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </a>
    @endif
</div>
