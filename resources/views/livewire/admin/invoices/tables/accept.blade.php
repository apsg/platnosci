<div class="flex space-x-1 justify-around">
    @if(!empty($externalId))
        {{ $externalId }}
    @else
        <select wire:change="saveProvider({{$id}}, $event.target.value)" name="provider">
            <option value="">...</option>
            @foreach(config('invoice.providers') as $name => $data)
                <option
                    @if($provider == $name) selected @endif
                value="{{ $name }}">
                    {{ $data['name'] }} ({{ $name }})
                </option>
            @endforeach
        </select>
        @if(!empty($provider))
            <a href="{{ route('admin.invoices.accept', $id) }}"
               class="mx-2 my-2 bg-white transition duration-150 ease-in-out rounded text-gray-800 border border-gray-300 px-6 py-2 text-xs hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-800"
            >
                <x-icon name="check" class="w-5 h-5 inline"></x-icon>
                Akceptuj
            </a>
        @endif
    @endif
</div>
