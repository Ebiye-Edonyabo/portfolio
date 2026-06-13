<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? 'Ebiye-Edonyabo' }}</title>

         <!-- Favicon section -->
        <link rel="icon" type="image/png" href="/favicon.png" sizes="96x96" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/b22f0a74ef.js" crossorigin="anonymous"></script>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-dotted">

        {{-- header --}}
        <x-header />

        <x-notification />

        {{ $slot }}

        {{-- footer --}}
        <footer class="bg-gray-500/10 w-full">
            <section class="w-full mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 text-center">
                <h4 class="font-extrabold xl:text-8xl lg:text-7xl text-5xl md:text-6xl text-primary-500 tracking-wide w-full block">
                    Ebiye-Edonyabo
                </h4>
            </section>
        </footer>
 
        @livewireScripts
    </body>
</html>
