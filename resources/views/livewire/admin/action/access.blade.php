<x-card>
    <h3 class="font-bold">Przyznaj dostęp do kursu</h3>
    <label>
        Platforma:
    </label>
    <select
        class="block appearance-none w-full my-2 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        wire:model="selected"
        wire:change="loadCourses"
    >
        <option value="">wybierz platformę</option>
        @foreach($providers as $provider)
            <option value="{{ $provider }}">{{ $provider }}</option>
        @endforeach
    </select>

    @if($selected)
        <label>
            Kurs:
        </label>
        <select
            class="block appearance-none w-full mt-2 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            wire:model="courseId"
        >
            <option value="">Wybierz kurs</option>
            @foreach($courses as $course)
                <option value="{{$course['id'] }}">{{ $course['title'] }}</option>
            @endforeach
        </select>
    @endif

    <x-slot name="footer">
        <div class="flex justify-between items-center">
            <x-delete-form :action="route('admin.actions.destroy', $action)"></x-delete-form>
            <div>
                <div class="inline">
                    @if (session()->has('message'))
                        <div class="alert alert-success text-green-700">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <button
                    @if(empty($selected) || empty($courseId)) disabled @endif
                    wire:click="save"
                    class="inline bg-blue-500 hover:bg-blue-700 disabled:bg-blue-300 text-white font-bold py-2 px-4 rounded">
                    Zapisz
                </button>
            </div>
        </div>
    </x-slot>
</x-card>
