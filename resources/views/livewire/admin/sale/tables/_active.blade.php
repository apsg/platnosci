<div>
    <form method="post" action="{{ route('admin.sales.toggle', $id) }}"  class="inline">
        @csrf
        @method('post')

        @if($isActive)
        <button
            class="mx-2 my-2 bg-white transition duration-150 ease-in-out rounded text-gray-800 border border-green-400 px-6 py-2 text-xs hover:bg-green-100-100 focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-800"
        >
            <x-icon name="check" class="w-5 h-5 inline text-green-400"></x-icon>
        </button>
        @else
            <button
                class="mx-2 my-2 bg-white transition duration-150 ease-in-out rounded text-gray-800 border border-red-400 px-6 py-2 text-xs hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-800"
            >
                <x-icon name="pause" class="w-5 h-5 inline text-red-400"></x-icon>
            </button>
        @endif
    </form>
</div>
