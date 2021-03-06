<x-app-layout>
    <x-slot name="title">Prośby o faktury</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Prośby o faktury
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <livewire:admin.invoices.index/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
