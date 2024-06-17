<div>
    <div class="text-center block md:hidden">
        <div class="pb-12 border-b border-gray-200 mb-12">
            @if(!empty($sale->logo_url))
                <img src="{{ $sale->logo_url }}" class="mx-auto" style="max-width: 250px"/>
            @else
                <img src="{{ \App\Images::logo() }}" class="mx-auto" style="max-width: 250px"/>
            @endif
        </div>
        @if(!empty($sale->counter))
            <div class="pb-3 md:pb-5 text-xl text-pink-600 font-bold">
                <p>Promocja dostępna tylko przez</p>
                <x-counter :counter="$sale->counter"></x-counter>
            </div>
        @endif
        @if(!empty($sale->icon_url))
            <img src="{{ $sale->icon_url }}" class="mb-5 max-h-20 mx-auto"/>
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
    </div>
    <div class="mb-8 hidden md:block">
        <div class="flex justify-between mb-2">
            <div class="text-xs content-start">
                Dane zamówienia
            </div>
            <div class="text-xs content-end">
                Płatność
            </div>
        </div>
        <div class="flex">
            <div class="color-cta font-size-5 pr-5">
                &#11044;
            </div>
            <div class="w-full pt-1">
                <div class="hr-cta"></div>
            </div>
            <div class="text-gray-500 font-size-5 pl-5">
                &#9711;
            </div>
        </div>
    </div>

    <h2 class="text-2xl mb-5">
        Szczegóły zamówienia
    </h2>
    <form>
        @csrf
        <div class="mb-5">
            <x-input
                wire:model.debounce.1s="email"
                class="pr-28"
                type="email"
                label="Email"
                placeholder="Adres email"/>
        </div>
        <div class="mb-5">
            <div class="">
                <div class="flex justify-between items-end mb-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400"
                           for="f7a42fe7211f98ac7a60a285ac3a9e87">
                        Numer telefonu

                        <button data-tooltip-target="tooltip-right"
                                data-tooltip-placement="right"
                                type="button"
                                data-tooltip-style="light"
                                class="ms-3 mb-2 md:mb-0 text-gray-900 w-4 h-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                                <path strokeLinecap="round" strokeLinejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                            </svg>
                        </button>

                        <div id="tooltip-right" role="tooltip"
                             class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip text-xs">
                            Numer telefonu potrzebny nam jest w przypadku literówki<br /> w mailu i/lub potwierdzenia zakupu.
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </label>
                </div>

                <div class="relative rounded-md  shadow-sm ">
                    <input type="text" autocomplete="off"
                           class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm pr-28"
                           wire:model.debounce.1s="phone" placeholder="Numer telefonu" name="phone"
                           id="f7a42fe7211f98ac7a60a285ac3a9e87">
                </div>
            </div>
        </div>

        <div class="mb-5">
            <div class="rounded bg-blue-50 p-4 text-sm">
                <x-icon name="information-circle" class="w-5 h-5 inline"/>
                <span class="font-bold"> Potrzebujesz fakturę?</span> Po udanym zakupie otrzymasz link z instrukcją jak
                uzyskać fakturę.
            </div>
        </div>
        <div class="">
            <div class="flex content-center">
                <x-checkbox
                    wire:model="accept"
                    label=""
                    value="1"
                />
                @if(empty($sale->policy_url))
                    <div class="ml-3">
                        Akceptuję
                        <a href="{{ url($sale->rules_url) }}"
                           class="text-gray-500"
                           target="_blank"
                        >Regulamin i politykę prywatności</a>
                    </div>
                @else
                    <div class="ml-3">
                        Akceptuję
                        <a href="{{ url($sale->rules_url) }}"
                           class="text-gray-500"
                           target="_blank"
                        >Regulamin </a>
                        i
                        <a href="{{ url($sale->policy_url) }}"
                           class="text-gray-500"
                           target="_blank"
                        > politykę prywatności</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="my-5" style="height: 65px">
            <x-button
                wire:click="order"
                label="Zapłać {{ $sale->format('price') }} PLN"
                class="pay-button"
            />
        </div>
        @if(!empty($sale->omnibus_price))
            <div class="text-xs">
                {{ $sale->omnibus_price }} PLN - Najniższa cena z 30 dni przed obniżką
            </div>
        @endif
        <x-errors only="rules"/>

    </form>
</div>
