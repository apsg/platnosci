<div class="flex space-x-1 justify-around">

    <a href="{{ route('admin.invoices.accept', $id) }}"
       class="mx-2 my-2 bg-white transition duration-150 ease-in-out rounded text-gray-800 border border-gray-300 px-6 py-2 text-xs hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-800"
    >
        <x-icon name="check" class="w-5 h-5 inline"></x-icon>
        Akceptuj
    </a>

    <x-delete-form :action="route('admin.invoices.delete', $id)">
        Usuń
    </x-delete-form>
</div>
