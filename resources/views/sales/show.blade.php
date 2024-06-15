<x-sale-layout>

    <x-slot name="title">
        {{ $sale->description }}
    </x-slot>

    <x-slot name="left">
        <div class="min-h-[300px] flex-col justify-between ">
            <div>
                <div class="pb-12 border-b border-gray-200 mb-12">
                    <img src="{{ \App\Images::logo() }}" class="mx-auto" style="max-width: 250px"/>
                </div>
                @if(!empty($sale->counter))
                    <div class="pb-3 md:pb-5 text-xl text-pink-600 font-bold">
                        <p>Promocja dostępna tylko przez</p>
                        <x-counter :counter="$sale->counter"></x-counter>
                    </div>
                @endif
                @if(!empty($sale->icon_url))
                    <img src="{{ $sale->icon_url }}" style="max-height: 140px " class="mb-5"/>
                @endif
                @if(!empty($sale->title))
                    <h1 class="text-2xl font-bold mb-5">
                        {{ $sale->title }}
                    </h1>
                @endif
                <p class="pb-5" style="color: #141311B2;">
                    {{ $sale->description }}
                </p>
                @if($sale->full_price)
                    <div class="line-through decoration-2 full-price font-semibold">
                        {{ $sale->format('full_price') }} PLN
                    </div>
                @endif
                <div class="price font-bold">
                    {{ $sale->format('price') }} PLN
                </div>

                <div class="border-t border-gray-200 mt-5 pt-5 ">
                    @if(!empty($sale->secondary_description))
                        {!!  nl2br($sale->secondary_description) !!}
                    @else
                        <div class="grid grid-cols-12 gap-y-3">

                            <div class="col-span-1 text-center content-center">
                                <img class="mx-auto" src="{{ url('/images/icon_1.svg') }}"/>
                            </div>
                            <p class="descriptions col-span-11 content-center">
                                Bezpieczne Płatności
                            </p>
                            <div class="col-span-1 text-center content-center">
                                <img class="mx-auto" src="{{ url('/images/icon_2.svg') }}"/>
                            </div>
                            <p class="descriptions col-span-11 content-center">
                                Natychmiastowy dostęp
                            </p>
                            <div class="col-span-1 text-center content-center">
                                <img class="mx-auto" src="{{ url('/images/icon_3.svg') }}"/>
                            </div>
                            <p class="descriptions col-span-11 content-center">
                                Transparentna Platforma: Maratony Excela, Zaufani trenerzy
                            </p>
                            <div class="col-span-1 text-center content-center">
                                <img class="mx-auto" src="{{ url('/images/icon_4.svg') }}"/>
                            </div>
                            <p class="descriptions col-span-11 content-center">
                                Najlepsza okazja + 30 dniowy zwrot
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="topright">
        <div class="mb-16">
            <livewire:testimonials/>
        </div>
    </x-slot>

    <div class="p-5">
        <livewire:order :sale="$sale"/>
    </div>

</x-sale-layout>
