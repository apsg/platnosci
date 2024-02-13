<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
        <div class="md:min-h-screen w-2/3 xl:w-1/2 p-1 md:p-6 flex-col justify-center lg:px-12 xl:px-24  hidden md:flex"
             style="background: #FFF3F0 0% 0% no-repeat padding-box">
            <aside class="left-box px-5 lg:px-12 xl:px-24 py-12">
                {{ $left }}
            </aside>
        </div>
    @endif
    <main class="md:min-h-screen md: w-1/3 xl:w-1/2 flex flex-col justify-center">
        <div class="px-5 lg:px-12 xl:px-24">
            <div class="hidden md:block">
                {{ $topright }}
            </div>

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
