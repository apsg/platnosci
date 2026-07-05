<x-sale-layout>

    <x-slot name="title">
        {{ $sale->description }}
    </x-slot>

    @if($sale->is_active)
        <x-slot name="left">
            <div class="min-h-[300px] flex-col justify-between ">
                <div>
                    <div class="pb-12 border-b border-gray-200 mb-12">
                        @if(!empty($sale->logo_url))
                            <img src="{{ $sale->logo_url }}" class="mx-auto" style="max-width: 250px"/>
                        @else
                            <img src="{{ \App\Images::logo() }}" class="mx-auto" style="max-width: 250px"/>
                        @endif
                    </div>
                    @if(!empty($sale->counter))
                        <div class="pb-3 md:pb-5 text-xl  font-bold" style="color:#ec5732">
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
                            {{ $sale->format('full_price', true) }} PLN
                        </div>
                    @endif
                    <div class="price font-bold">
                        <livewire:show-price :initial-price="$sale->format('price', !$sale->has_pesel)"/>
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
                @if(!$sale->disable_comments)
                    <livewire:testimonials/>
                @endif
            </div>
        </x-slot>

        <div class="p-5">
            <livewire:order :sale="$sale"/>
        </div>

        <x-slot name="bottom">
            <div class="p-5 ">
                <svg style="height: 40px; display: inline-block" id="a" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23.46 23.45"><defs><style>.b{fill:#03ca75;}.c{fill:#fff;}</style></defs><polygon class="c" points="18.89 8 16.83 10.08 14.81 12.12 10.55 16.41 9.8 17.16 4.6 11.96 6.35 10.2 9.8 13.64 10.82 12.61 10.99 12.44 12.53 10.88 12.64 10.76 14.45 8.94 17.13 6.24 18.89 8"/><path class="b" d="M0,0v23.45h17.6l1.58-1.58,2.7-2.71,1.58-1.58V0H0ZM16.83,10.08l-2.02,2.04-4.27,4.29-.75.75-5.21-5.2,1.76-1.76,3.45,3.45,1.02-1.04.16-.17,1.55-1.56.11-.11,1.81-1.83,2.68-2.69,1.76,1.76-2.06,2.08Z"/></svg>
                Zweryfikuj firmę w rejestrze MEN
                <a href="#" target="_blank" class="ml-3 font-semibold" style="color: #03ca75">Sprawdź tutaj</a>
            </div>
        </x-slot>
    @else
        <x-slot name="left">
            <div class="min-h-[300px] flex-col justify-between ">
                <div>
                    <h1 class="text-2xl font-bold mb-5">
                        Przepraszamy, ten produkt jest chwilowo niedostępny
                    </h1>
                </div>
            </div>
        </x-slot>
    @endif
</x-sale-layout>
