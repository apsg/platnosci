<div>
    <div class="px-8 pt-6 mb-4">
        <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
           href="{{ route('admin.sales.index') }}">
            < Wróć do listy sprzedaży
        </a>
    </div>
    <form
        wire:submit.prevent="update"
        class="bg-white px-8 pt-6 pb-8 mb-4"
        method="post">
        @csrf

        <div class="mb-4 flex ">
            <input class="appearance-none rounded bg-gray-100 p-3 mr-3"
                   disabled
                   value="{{ $sale->url() }}">
            <a
                target="_blank"
                class="rounded bg-purple-500 hover:bg-purple-700 text-white p-3"
                href="{{ $sale->url() }}">
                <x-icon name="external-link" class="w-5 h-5 inline"></x-icon>
            </a>
        </div>

        <x-input
            label="Nazwa sprzedaży (tylko do użytku wewnętrznego, ta nazwa nie pokaże się klientowi)."
            placeholder="your name"
            wire:model="sale.name"
        />

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Tytuł sprzedaży
            </label>
            <input
                wire:model.debounce.500ms="sale.title"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="title"
                type="text"
                placeholder="np. produkt..."
                required
            >
            @error('sale.description') <span class="error text-red-700">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Opis sprzedaży (ten opis pokaże się klientowi jako produkt i będzie pozycją na fakturze).
            </label>
            <input
                wire:model.debounce.500ms="sale.description"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="description"
                type="text"
                placeholder="np. produkt..."
                required
            >
            @error('sale.description') <span class="error text-red-700">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                Kwota (PLN)
            </label>
            <input
                wire:model.debounce.500ms="sale.price"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="price"
                type="number"
                step="0.01"
                min="0.01"
                required
            >
            @error('sale.price') <span class="error text-red-700">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="full_price">
                Kwota przed obniżką (podaj tylko, jeśli sprzedaż ma być z kwotą "obniżoną").
            </label>
            <input
                wire:model.debounce.500ms="sale.full_price"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="full_price"
                type="number"
                step="0.01"
                min="0.01"
            >
            @error('sale.full_price') <span class="error text-red-700">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="omnibus_price">
                Kwota z dyrektywy omnibus
            </label>
            <input
                wire:model.debounce.500ms="sale.omnibus_price"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="omnibus_price"
                type="number"
                step="0.01"
                min="0.01"
            >
            @error('sale.full_price') <span class="error text-red-700">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="full_price">
                Licznik w sekundach (pozostaw puste, jeśli licznik ma być wyłączony)
            </label>
            <input
                wire:model.debounce.500ms="sale.counter"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="full_price"
                type="number"
                step="1"
                min="0"
            >
            @error('sale.full_price') <span class="error text-red-700">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="rules">
                Link do regulaminu
            </label>
            <input
                wire:model.debounce.500ms="sale.rules_url"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="rules"
                type="text"
            >
            @error('sale.rules_url') <span class="error text-red-700">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="policy">
                Link do polityki prywatności
            </label>
            <input
                wire:model.debounce.500ms="sale.policy_url"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="policy"
                type="text"
            >
            @error('sale.rules_url') <span class="error text-red-700">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="redirect">
                Link przekierowania po udanej płatności
            </label>
            <input
                wire:model.debounce.500ms="sale.redirect_url"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="redirect"
                type="text"
            >
            @error('sale.redirect_url') <span class="error text-red-700">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="icon_url">
                Link do ikony
            </label>
            <p class="text-sm">
                Możesz tu użyć domyślnej ikony - skopiuj i wklej poniższy adres: <br/>
                <code>
                    {{ url('/images/platnosci_inauka.png') }}
                </code>
            </p>
            <input
                wire:model.debounce.500ms="sale.icon_url"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="icon_url"
                type="text"
            >
            @error('sale.icon_url') <span class="error text-red-700">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="logo_url">
                Link do logo (obrazek na samej górze strony)
            </label>
            <p class="text-sm">
                Zostaw puste by ustawić domyślny
            </p>
            <input
                wire:model.debounce.500ms="sale.logo_url"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="logo_url"
                type="text"
            >
            @error('sale.logo_url') <span class="error text-red-700">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="secondary_description">
                Dolny opis
            </label>
            <p class="text-sm">
                Opis pod ceną z ikonami na początku - możesz wkleić tu HTML i użyć ikon <a
                    href="https://fontawesome.com/icons" target="_blank">FontAwesome</a>
            </p>
            <textarea
                wire:model.debounce.500ms="sale.secondary_description"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="secondary_description"
                type="text"
                rows="10"
            ></textarea>
            @error('sale.secondary_description') <span class="error text-red-700">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="provider">
                Konto systemu płatności
            </label>
            <select
                wire:model.debounce.500ms="sale.payments_provider"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="provider"
                type="text"
            >
                <option value="">--</option>
                @foreach($paymentSystems as $system)
                    <option
                        value="{{ $system['provider'] }}"
                        @if($sale->payments_provider === $system['provider'])
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
                wire:model.debounce.500ms="sale.default_invoice_provider"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="provider"
                type="text"
            >
                <option value="">--</option>
                @foreach($invoiceSystems as $system)
                    <option
                        value="{{ $system['provider'] }}"
                        @if($sale->default_invoice_provider === $system['provider'])
                            selected
                        @endif
                    >{{ $system['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="provider">
                Wyłączone komentarze
            </label>
            <select
                wire:model.debounce.500ms="sale.disable_comments"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="provider"
                type="text"
            >
                <option value="0" @if(!$sale->disable_comments) selected @endif>Nie</option>
                <option value="1" @if($sale->disable_comments) selected @endif>Tak</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Zapisz
            </button>
            @if (session()->has('message'))
                <div class="alert alert-success text-green-700 inline">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </form>
</div>
