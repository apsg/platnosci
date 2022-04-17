<div class="p-5">
    @if(!$order->isPaid())
        <div class="p-3 bg-blue-100 ">
            <x-icon name="information-circle" class="w-5 h-5 inline"/>
            Nie możemy wystawić faktury do tego zamówienia, ponieważ nie zostało ono jeszcze opłacone.
        </div>
    @elseif($isSent)
        <div class="p-3 bg-green-100 ">
            <x-icon name="information-circle" class="w-5 h-5 inline"/>
            Zarejestrowaliśmy Twoją prośbę o fakturę. Po weryfikacji wyślemy fakturę na maila podanego przy zamówieniu.
        </div>
    @elseif($order->invoice_request)
        <div class="p-3 bg-blue-100 ">
            <x-icon name="information-circle" class="w-5 h-5 inline"/>
            Do tego zamówienia wygenerowano już prośbę o fakturę. Poczekaj na jego weryfikację lub skontaktuj się z nami w
            celu uzyskania pomocy.
        </div>
    @else
        <h1 class="text-xl font-bold">Podaj dane do faktury</h1>
        <form>
            <div class="mb-5">
                <x-inputs.maskable
                    wire:model.lazy="nip"
                    class="pr-28"
                    label="NIP"
                    placeholder="NIP"
                    mask="###-###-##-##"
                />
            </div>
            <div class="mb-5">
                <x-input
                    wire:model.debounce.1s="name"
                    class="pr-28"
                    type="text"
                    label="Nazwa firmy"
                    placeholder="Nazwa firmy"/>
            </div>
            <div class="mb-5">
                <x-input
                    wire:model.debounce.1s="address"
                    class="pr-28"
                    type="text"
                    label="Adres"
                    placeholder="Adres"/>
            </div>

            <div>
                <x-button
                    positive
                    icon="annotation"
                    wire:click="send"
                    label="Wyślij prośblę o fakturę"
                />
            </div>
        </form>
    @endif
</div>
