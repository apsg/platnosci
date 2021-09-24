<div>
    <form
        wire:submit.prevent="update"
        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
        action="{{ route('payments.update', $payment) }}"
        method="post">
        @csrf

        <div class="mb-4 grid-cols-2">
            <div class="w-1/2">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Link do płatności:
                </label>
                <livewire:copy :text="$payment->url"/>
            </div>
            <div class="w-1/2">
                <label>Status płatności:</label>
                {{ $payment->isConfirmed() }}
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Imię i nazwisko / Nazwa odbiorcy
            </label>
            <input
                wire:model.debounce.500ms="name"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="name"
                type="text"
                placeholder="np. Darth Vader"
                @if(!$payment->isEditable()) disabled @endif
            >
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input
                wire:model.debounce.500ms="email"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="email"
                type="email"
                placeholder="email"
                @if(!$payment->isEditable()) disabled @endif
            >
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Opis płatności
            </label>
            <input
                wire:model.debounce.500ms="description"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="description" type="text" placeholder="np. zaliczka za pobyt..."
                @if(!$payment->isEditable()) disabled=@endif
                    </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Kwota (PLN)
                </label>
                <input
                    wire:model.debounce.500ms="amount"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="password"
                    type="number"
                    step="0.01"
                    min="0.01"
                    placeholder="np. 1 Sasin"
                    @if(!$payment->isEditable()) disabled @endif
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
                    @if(!$payment->isEditable()) disabled @endif
                >
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Zapisz
                </button>
                <div>
                    <button
                        wire:click.prevent="mail"
                        class="inline bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button">
                        Wyślij maila do klienta
                        @if($isMailed)
                            <span class="text-white font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </span>
                        @endif
                    </button>
                </div>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                   href="{{ route('payments.index') }}">
                    Wróć do listy płatności
                </a>
            </div>
    </form>
</div>
