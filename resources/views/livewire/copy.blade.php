<div class="w-full">
    <div class="flex items-center border-b border-teal-500 py-2">
        <div class="relative">
            <input
                wire:model="text"
                type="text"
                class="h-14 w-96 pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                placeholder="Search anything..."
                onclick="copyToClipboard('{{ $inputId }}')"
                onfocus="copyToClipboard('{{ $inputId }}')"
                id="{{ $inputId }}"
                disabled
            >
            <div class="absolute top-2 right-2">
                <button
                    class="h-10 w-10 text-white rounded-lg bg-green-700 hover:bg-green-900 flex justify-center align-middle"
                    type="button"
                    onclick="copyToClipboard('{{ $inputId }}')"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white " fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
