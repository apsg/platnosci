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
                @foreach(config('payu') as $name => $data)
                    <option
                        value="{{ $name }}"
                        @if($paymentsProvider === $name)
                            selected
                        @endif
                    >{{ $data['name'] }}</option>
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
