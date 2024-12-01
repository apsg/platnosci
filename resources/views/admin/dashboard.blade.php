<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">

                <div class="p-2">
                    <livewire:stats days="1" />
                    <livewire:stats days="7" />
                    <livewire:stats days="30" />
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
