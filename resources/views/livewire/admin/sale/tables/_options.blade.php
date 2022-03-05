<div>
    <a href="{{ route('admin.sales.edit', $id) }}"
       class="mx-2 my-2 bg-white transition duration-150 ease-in-out rounded text-gray-800 border border-gray-300 px-6 py-2 text-xs hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-800"
    >
        <x-icon name="pencil" class="w-5 h-5 inline"></x-icon>
        Edytuj
    </a>
    <x-delete-form :action="route('admin.sales.delete', $id)">
        Usuń
    </x-delete-form>
</div>
