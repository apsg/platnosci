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
                <x-inputs.maskable
                    wire:model="nip"
                    label="NIP"
                    mask="###-###-##-##"
                    placeholder="NIP"
                />
            </div>
        @endif

        <x-button
            positive
            icon="cash"
            label="Zapłać {{ $sale->format('price') }} PLN"
        />
    </form>
</div>
