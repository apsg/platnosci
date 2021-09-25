<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">

                <div class="flex items-center justify-center" x-data="{ circumference: 2 * 22 / 7 * 120 }">
                    <svg class="transform -rotate-90 w-72 h-72">
                        <circle cx="145" cy="145" r="120" stroke="currentColor" stroke-width="30" fill="transparent"
                                class="text-gray-700"/>

                        <circle cx="145" cy="145" r="120" stroke="currentColor" stroke-width="30" fill="transparent"
                                :stroke-dasharray="circumference"
                                :stroke-dashoffset="circumference - 20 / 100 * circumference"
                                class="text-blue-500 "/>
                    </svg>
                    <span class="absolute text-5xl" x-text="`20%`"></span>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
