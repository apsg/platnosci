<x-sale-layout>

    <x-slot name="title">
        {{ $order->id }}
    </x-slot>

    <x-slot name="left">
        <div class="min-h-[300px] flex-col justify-between">

            <livewire:order.status :order="$order"/>

        </div>
    </x-slot>

</x-sale-layout>
