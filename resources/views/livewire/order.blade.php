<div>
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
            <x-input
                wire:model.debounce.1s="phone"
                class="pr-28"
                type="text"
                label="Numer telefonu"
                placeholder="Numer telefonu"
            />
        </div>

        <div class="mb-5">
            <div class="rounded bg-blue-100 p-2 text-sm">
                <x-icon name="information-circle" class="w-5 h-5 inline"/>
                Potrzebujesz fakturę? Po udanym zakupie otrzymasz link z instrukcją jak uzyskać fakturę.
            </div>
        </div>
        <div class="flex justify-between content-center">
            <div class="flex content-center">
                <x-checkbox
                    wire:model="accept"
                    label=""
                    value="1"
                />
                <div class="ml-3">
                    Akceptuję
                    <a href="{{ url($sale->rules_url) }}"
                       class="text-gray-500"
                       target="_blank"
                    >Regulamin i politykę prywatności</a>
                </div>
            </div>
            <div>
                <x-button
                    positive
                    icon="cash"
                    wire:click="order"
                    label="Zapłać {{ $sale->format('price') }} PLN"
                />
            </div>
        </div>
        <x-errors only="rules" />

    </form>
</div>
