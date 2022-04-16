<div>

    <h3 class="text-xl mb-5 font-bold">Zamówienie numer #{{ $order->id }}</h3>
    <div class="font-bold">
        {{ $order->sale->description }} - {{ number_format($order->price,2) }} PLN
    </div>
    <div>
        Dane zamawiającego: <br>
        <x-icon name="mail" class="h-5 w-5 inline"/>
        {{ $order->email }}
        @if(!empty($order->phone))
            <x-icon name="phone" class="h-5 w-5 inline"/>
            {{ $order->phone }}
        @endif
    </div>

    <div class="min-h-[300px] flex flex-col items-center justify-center" wire:poll.5s>
        @if($order->isPaid())
            <div>
                <object type="image/svg+xml" width="300" data="{{ asset('/images/status.svg') }}">
                    <img src="{{ asset('/images/status.svg') }}"/>
                </object>
                <p class="font-bold rounded p-3 text-green-800 border border-green-800">
                    Zamówienie opłacone. Na Twój adres email otrzymasz dalsze informacje dotyczące zakupionych produktów
                    oraz faktury za zakup.
                </p>
            </div>
        @else
            <div class="p-3 bg-indigo-200 rounded border-indigo-300 border flex">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-indigo-700" xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Czekamy na weryfikację Twojej płatności przez bank...
            </div>
        @endif
    </div>
</div>
