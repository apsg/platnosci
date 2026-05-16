<x-app-layout>
    <x-slot name="title">Zamówienia</x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Zamówienia
            </h2>
            <form method="GET" action="{{ route('admin.orders.export') }}" class="flex items-center gap-2">
                Pobierz listę MEN od:
                <input type="date" name="date"
                       value="{{ now()->subMonth()->format('Y-m-d') }}"
                       class="border border-gray-300 rounded-md text-sm px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">
                    Pobierz CSV
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <livewire:admin.orders.index/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
