<x-card>
    <h3 class="font-bold">Dodaj użytkownika do grupy MailerLite</h3>
    <label>
        Konto:
    </label>
    <select
        class="block appearance-none w-full my-2 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        wire:model="selected"
        wire:change="loadGroups"
    >
        <option value="">wybierz konto</option>
        @foreach($providers as $provider)
            <option value="{{ $provider }}">{{ $provider }}</option>
        @endforeach
    </select>

    @if($selected)
        <label>
            Grupa:
        </label>
        <select
            class="block appearance-none w-full mt-2 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            wire:model="groupId"
        >
            <option value="" disabled>Wybierz grupę</option>
            @foreach($groups as $group)
                <option value="{{ $group['id']  }}" wire:key="group-{{ $group['id'] }}">{{ $group['name'] }}</option>
            @endforeach
        </select>
    @endif

    <x-slot name="footer">
        <div class="flex justify-between items-center">
            <x-delete-form :action="route('admin.actions.destroy', $action)"></x-delete-form>
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success text-green-700 inline">
                        {{ session('message') }}
                    </div>
                @endif
                <button
                    @if(empty($selected) || empty($groupId)) disabled @endif
                    wire:click="save"
                    class="inline bg-blue-500 hover:bg-blue-700 disabled:bg-blue-300 text-white font-bold py-2 px-4 rounded">
                    Zapisz
                </button>
            </div>
        </div>
    </x-slot>
</x-card>
