<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    @livewireStyles

</head>
<body class="w-full h-full bg-cover bg-center" style='background-image: url("{{ asset('/images/bg.jpg') }}")'>
<div class="min-h-screen flex">
    @if(isset($left))
        <div class="min-h-screen bg-gray-200 w-1/2 p-6 flex flex-col justify-center flex">
            <aside class="mx-auto">
                {{ $left }}
            </aside>
        </div>
    @endif
    <main class="min-h-screen w-1/2 flex flex-col justify-center flex">
        <div class="p-5 w-2/3 bg-gray-100 shadow rounded-r">
        {{ $slot }}
        </div>
    </main>
</div>

@stack('modals')

@livewireScripts
</body>
</html>
