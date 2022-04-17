<x-sale-layout>

    <x-slot name="title">
        {{ $sale->description }}
    </x-slot>

    <x-slot name="left">
        <div class="min-h-[300px] flex-col justify-between">
            <div>
                @if(!empty($sale->counter))
                    <div class="pb-3 md:pb-5 text-xl text-pink-600 font-bold">
                        <p>Promocja dostępna tylko przez</p>
                        <x-counter :counter="$sale->counter"></x-counter>
                    </div>
                @endif
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
        </div>
    </x-slot>

    <div class="p-5">
        <livewire:order :sale="$sale"/>
    </div>

</x-sale-layout>
