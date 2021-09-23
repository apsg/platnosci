<div>
    <!-- Row -->
    <div class="w-full xl:w-3/4 lg:w-11/12 flex">
        <!-- Col -->
        <div
            class="w-full h-auto bg-gray-400 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg"
            style="background-image: url('{{ url('/images/bg.webp') }}'); background-position: center center"
        ></div>
        <!-- Col -->
        <div class="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none">
            <h3 class="pt-4 text-2xl text-center">
                Dokonaj płatności
            </h3>
            <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded" action="/" >
                <div class="mb-4 md:flex md:justify-between">
                    <div class="mb-4 md:mr-2 md:mb-0">

                    </div>
                    <div class="">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                        Imię i nazwisko / nazwa klienta
                    </label>
                    <input
                        class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="email"
                        type="name"
                        placeholder="Imię i nazwisko"
                        wire:model="name"
                    />
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                        Email
                    </label>
                    <input
                        class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="email"
                        type="email"
                        placeholder="Email"
                        wire:model="email"
                    />
                </div>

                <hr class="mb-4"/>
                <div class="mb-4 mt-2">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                        Tytuł płatności:
                    </label>
                    <p class="text-2xl">{{ $payment->description }}</p>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                        Kwota płatności brutto:
                    </label>
                    <p class="text-2xl">{{ $payment->amount_formatted }} PLN</p>
                </div>
                <div class="mb-4">

                    <p>
                        Przed dokonaniem płatności konieczne jest zapoznanie się z
                        <a href="{{ $payment->rules_url ?? config('app.rules_url') }}"
                           target="_blank"
                           class="font-bold text-blue-700"
                        >
                            regulaminem
                        </a>.
                    </p>

                    <label class="inline-flex items-center mt-3">
                        <input
                            type="checkbox"
                            class="form-checkbox h-5 w-5 text-green-600"
                            wire:model="isConfirmed">
                        <span class="ml-2 text-gray-700">Akceptuję
                            <a href="{{ $payment->rules_url ?? config('app.rules_url') }}"
                               target="_blank"
                               class="font-bold text-blue-700"
                            >
                            regulamin.
                        </a></span>
                    </label>
                </div>
                <div class="mb-6 text-center">
                    <button
                        class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-600 focus:outline-none focus:shadow-outline disabled:opacity-50"
                        type="submit"
                        @if(!$isConfirmed) disabled @endif
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Dokonaj płatności
                    </button>
                </div>
                <hr class="mb-6 border-t"/>
                <div class="text-center">
                    <a
                        target="_blank"
                        class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                        href="https://skret.eu/kontakt/"
                    >
                        Zauważyłeś błąd? Skontaktuj się z nami.
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
