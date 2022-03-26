<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nowa sprzedaż
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:admin.sale.edit :sale="$sale"/>
            </div>

            <div class="text-center pt-6">
                <p>Po udanej płatności:</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor"
                     class="block mx-auto text-2xl text-green-700" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                </svg>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-3 flex">
                    @foreach(\App\Domains\Actions\ActionsHelper::list() as $action => $name)
                        <div class="p-5">
                            <a href="{{ route('admin.sales.add_action', [$sale, $action]) }}"
                               class="p-3 border-gray-300 border rounded bg-gray-50 hover:bg-blue-100">
                                <x-icon name="plus" class="w-5 h-5 inline"/> {{ $name }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            @foreach($sale->actions()->onSuccess()->get() as $action)
                <x-action :action="$action" />
            @endforeach


            <div class="text-center pt-6">
                <p>Po nieudanej płatności:</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor"
                     class="block mx-auto text-2xl text-red-700" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                </svg>
            </div>
        </div>
    </div>
</x-app-layout>
