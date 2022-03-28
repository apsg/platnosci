<x-card>
    <h3 class="font-bold">Dodaj zamówienie w Baselinker</h3>
    <label>
        Konto:
    </label>
    <select
        class="block appearance-none w-full my-2 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        wire:model="selected"
        wire:change="loadProducts"
    >
        <option value="">wybierz konto</option>
        @foreach($providers as $provider)
            <option value="{{ $provider }}">{{ $provider }}</option>
        @endforeach
    </select>

    @if($selected)
        <label>
            Produkt:
        </label>
        <select
            class="block appearance-none w-full mt-2 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            wire:model="productId"
        >
            <option value="">Wybierz produkt</option>
            @foreach($products as $product)
                <option value="{{ $product['id']  }}">{{ $product['name'] }}</option>
            @endforeach
        </select>
    @endif

    <x-slot name="footer">
        <div class="flex justify-between items-center">
            <x-delete-form :action="route('admin.actions.destroy', $action)"></x-delete-form>
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success text-green-700 inline">
                        {{ session('message') }}
                    </div>
                @endif
                <button
                    @if(empty($selected) || empty($productId)) disabled @endif
                wire:click="save"
                    class="inline bg-blue-500 hover:bg-blue-700 disabled:bg-blue-300 text-white font-bold py-2 px-4 rounded">
                    Zapisz
                </button>
            </div>
        </div>
    </x-slot>
</x-card>
