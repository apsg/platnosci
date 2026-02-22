<div class="p-6">
    @if (session()->has('message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if ($invoice->accepted_at !== null)
        <div class="mb-4 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">Ta faktura została już zaakceptowana i nie może być edytowana.</span>
        </div>
    @endif

    <form wire:submit.prevent="save">
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="nip" class="block text-sm font-medium text-gray-700">NIP <span class="text-red-500">*</span></label>
                <input wire:model="nip" type="text" id="nip" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" {{ $invoice->accepted_at ? 'disabled' : '' }} required>
                @error('nip') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nazwa <span class="text-red-500">*</span></label>
                <input wire:model="name" type="text" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" {{ $invoice->accepted_at ? 'disabled' : '' }} required>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Adres <span class="text-red-500">*</span></label>
                <input wire:model="address" type="text" id="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" {{ $invoice->accepted_at ? 'disabled' : '' }} required>
                @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="postcode" class="block text-sm font-medium text-gray-700">Kod pocztowy <span class="text-red-500">*</span></label>
                <input wire:model="postcode" type="text" id="postcode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" {{ $invoice->accepted_at ? 'disabled' : '' }} required>
                @error('postcode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="city" class="block text-sm font-medium text-gray-700">Miasto <span class="text-red-500">*</span></label>
                <input wire:model="city" type="text" id="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" {{ $invoice->accepted_at ? 'disabled' : '' }} required>
                @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Data sprzedaży <span class="text-red-500">*</span></label>
                <input wire:model="date" type="date" id="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" {{ $invoice->accepted_at ? 'disabled' : '' }} required>
                @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="provider" class="block text-sm font-medium text-gray-700">Dostawca <span class="text-red-500">*</span></label>
                <select wire:model="provider" id="provider" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" {{ $invoice->accepted_at ? 'disabled' : '' }} required>
                    <option value="">Wybierz dostawcę...</option>
                    @foreach(config('invoice.providers') as $name => $data)
                        <option value="{{ $name }}">{{ $data['name'] }} ({{ $name }})</option>
                    @endforeach
                </select>
                @error('provider') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            @if ($invoice->accepted_at === null)
                <div class="flex justify-end gap-3">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Zapisz
                    </button>
                    @if ($this->canAccept())
                        <button type="button" wire:click="accept" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-500 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Wystaw fakturę
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </form>
</div>
