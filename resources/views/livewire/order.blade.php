<div>
    <h2 class="text-2xl mb-5">
        Szczegóły zamówienia
    </h2>
    <form>
        @csrf
        <div class="mb-5">
            <x-input
                wire:model="email"
                class="pr-28"
                type="email"
                label="Email"
                placeholder="Adres email"/>
        </div>
        <div class="mb-5">
            <x-input
                wire:model="name"
                class="pr-28"
                type="text"
                label="Imię i nazwisko / nazwa firmy"
                placeholder="Imię / nazwa"/>
        </div>

        <div class="mb-5">
            <x-toggle lg wire:model="invoice" class="inline" label="Potrzebuję fakturę"/>
        </div>
        @if(!empty($invoice))
            <div class="mb-5">
                <x-input
                    type="number"
                    min="100000000"
                    max="999999999"
                    wire:model="nip"
                    label="NIP"
                    placeholder="NIP"
                />
            </div>
            <div class="mb-5">
                <x-input
                    wire:model="address"
                    label="Adres"
                    placeholder="ulica, kod, miejscowość"
                />
            </div>
        @endif
        <div class="flex justify-between content-center">
            <div>
                <x-checkbox
                    wire:model="rules"
                    label="Akceptuję regulamin sprzedaży"
                />
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
    </form>
</div>
