<div>
    <form
        wire:submit.prevent="store"
        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
        action="{{ route('admin.sales.store') }}"
        method="post">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Nazwa płatności (tylko do użytku wewnętrznego, ta nazwa nie pokaże się klientowi).
            </label>
            <input
                wire:model.debounce.500ms="name"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="name"
                type="text"
                placeholder="np. dostęp do..., kampania X"
                required
            >
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Tytuł (ten opis pokaże się klientowi jako tytuł sprzedaży).
            </label>
            <input
                wire:model.debounce.500ms="title"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="title"
                type="text"
                placeholder="np. produkt..."
                required
            >
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Opis płatności (ten opis pokaże się klientowi jako produkt i będzie pozycją na fakturze).
            </label>
            <input
                wire:model.debounce.500ms="description"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="description"
                type="text"
                placeholder="np. produkt..."
                required
            >
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                Kwota (PLN)
            </label>
            <input
                wire:model.debounce.500ms="price"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="price"
                type="number"
                step="0.01"
                min="0.01"
                required
            >
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="full_price">
                Kwota przed obniżką (podaj tylko, jeśli sprzedaż ma być z kwotą "obniżoną").
            </label>
            <input
                wire:model.debounce.500ms="fullPrice"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="full_price"
                type="number"
                step="0.01"
                min="0.01"
            >
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="omnibus_price">
                Kwota z dyrektywy omnibus.
            </label>
            <input
                wire:model.debounce.500ms="omnibusPrice"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="omnibus_price"
                type="number"
                step="0.01"
                min="0.01"
            >
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="full_price">
                Licznik w sekundach (pozostaw puste, jeśli licznik ma być wyłączony)
            </label>
            <input
                wire:model.debounce.500ms="counter"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="full_price"
                type="number"
                step="1"
                min="0"
            >
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="rules">
                Link do regulaminu
            </label>
            <input
                wire:model.debounce.500ms="rulesUrl"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="rules"
                type="text"
            >
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="policy">
                Link do polityki prywatności
            </label>
            <input
                wire:model.debounce.500ms="policyUrl"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="policy"
                type="text"
            >
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="redirect">
                Link przekierowania po udanej płatności
            </label>
            <input
                wire:model.debounce.500ms="redirectUrl"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="redirect"
                type="text"
            >
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="iconUrl">
                Link do ikony
            </label>
            <input
                wire:model.debounce.500ms="iconUrl"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="iconUrl"
                type="text"
            >
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="provider">
                Konto systemu płatności
            </label>
            <select
                wire:model.debounce.500ms="paymentsProvider"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="provider"
                type="text"
            >
                <option value="">--</option>
                @foreach($paymentSystems as $system)
                    <option
                        value="{{ $system['provider'] }}"
                        @if($paymentsProvider === $system['provider'])
                        selected
                        @endif
                    >{{ $system['name'] }} ({{ $system['driver'] }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="provider">
                Domyślne konto fakturowania
            </label>
            <select
                wire:model.debounce.500ms="defaultInvoiceProvider"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="provider"
                type="text"
            >
                <option value="">--</option>
                @foreach($invoiceSystems as $system)
                    <option
                        value="{{ $system['provider'] }}"
                        @if($defaultInvoiceProvider === $system['provider'])
                            selected
                        @endif
                    >{{ $system['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Zapisz i przejdź dalej
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
               href="{{ route('admin.sales.index') }}">
                Wróć do listy sprzedaży
            </a>
        </div>
    </form>
</div>
