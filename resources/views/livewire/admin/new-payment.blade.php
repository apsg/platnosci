<div>
    <form
        wire:submit.prevent="store"
        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
        action="{{ route('payments.store') }}"
        method="post">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Imię i nazwisko / Nazwa odbiorcy
            </label>
            <input
                wire:model.debounce.500ms="name"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="name" type="text" placeholder="np. Darth Vader">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input
                wire:model.debounce.500ms="email"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="email" type="email" placeholder="email">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Opis płatności
            </label>
            <input
                wire:model.debounce.500ms="description"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="description" type="text" placeholder="np. zaliczka za pobyt...">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Kwota (PLN)
            </label>
            <input
                wire:model.debounce.500ms="amount"
                class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="password"
                type="number"
                step="0.01"
                min="0.01"
                placeholder="np. 1 Sasin"
            >
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="rules">
                Link do regulaminu
            </label>
            <input
                wire:model.debounce.500ms="rulesUrl"
                class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="rules"
                type="text"
            >
        </div>

        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Dodaj prośbę o płatność
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
               href="{{ route('payments.index') }}">
                Wróć do listy płatności
            </a>
        </div>
    </form>
</div>
