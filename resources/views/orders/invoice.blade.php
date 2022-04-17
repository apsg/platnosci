<x-sale-layout>

    <x-slot name="title">
        Podsumowanie zamówienia #{{ $order->id }}
    </x-slot>

    <x-slot name="left">
        <div class="min-h-[300px] flex-col justify-between">
            <livewire:order.status :order="$order"/>
        </div>
    </x-slot>

    <div class="p-3 min-h-[300px] flex flex-col justify-center">
        <livewire:order.invoice :order="$order"/>
    </div>

</x-sale-layout>
