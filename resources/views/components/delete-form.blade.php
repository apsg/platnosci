<form method="post" action="{{ $action }}"  class="inline">
    @csrf
    @method('delete')
    <button
        class="mx-2 my-2 bg-white transition duration-150 ease-in-out rounded text-gray-800 border border-red-400 px-6 py-2 text-xs hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-800"
    >
        <x-icon name="trash" class="w-5 h-5 inline"></x-icon>
        {{ $slot }}
    </button>
</form>
