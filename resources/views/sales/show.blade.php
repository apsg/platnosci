<x-sale-layout>

    <x-slot name="title">
        {{ $sale->description }}
    </x-slot>

    <x-slot name="left">
        <div class="min-h-[300px] flex flex-col justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-5">
                    {{ $sale->description }}
                </h1>
                @if($sale->full_price)
                    <div class="text-red-700 text-3xl line-through decoration-2">
                        {{ $sale->format('full_price') }} PLN
                    </div>
                @endif
                <div class="text-5xl text-green-700">
                    {{ $sale->format('price') }} PLN
                </div>
            </div>
            <div>
                <a href="{{ url($sale->rules_url) }}"
                   class="text-gray-500"
                   target="_blank"
                >Regulamin i polityka prywatności</a>
            </div>
        </div>
    </x-slot>

    <div>
        <livewire:order :sale="$sale"/>
    </div>

</x-sale-layout>
