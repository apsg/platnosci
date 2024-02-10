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

    @wireUiScripts

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    @livewireStyles

</head>
<body class="w-full h-full bg-cover bg-center" style='background: #FAFAFA 0% 0% no-repeat padding-box;'>
<div class="md:min-h-screen md:flex">
    @if(isset($left))
        <div class="md:min-h-screen md:w-1/2 p-6 flex flex-col justify-center flex px-24"
             style="background: #FFF3F0 0% 0% no-repeat padding-box">
            <aside class="left-box px-24 py-12">
                {{ $left }}
            </aside>
        </div>
    @endif
    <main class="md:min-h-screen md:w-1/2 xl:w-2/3 flex flex-col  justify-center">
        <div class="px-24">
            <div class="right-box">
                {{ $slot }}
            </div>
        </div>
    </main>
</div>

@stack('modals')
@livewireScripts

</body>
</html>
