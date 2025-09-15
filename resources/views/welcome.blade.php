<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Portfolio</title>

         <!-- Favicon section -->
        <link rel="icon" type="image/png" href="/favicon.png" sizes="96x96" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="">
     
    {{-- header --}}
    <header class="sticky z-50 top-3 px-2">
        <nav class="px-4 sm:px-6 py-1.5 max-w-screen-xl mx-auto flex justify-between items-center bg-gray-950/10 rounded-[10px]">

            {{-- logo --}}
            <a href="{{ url('/')}}">
                <img src="{{ asset('images/logo.png')}}" class="h-8" alt="brand Logo" />
            </a>
        
            {{-- contact me --}}
            <a href="" class="text-tiny-size bg-white/80 rounded-full px-2 py-1.5 hover:bg-gray-950/5">
                <i>Contact Me</i> 
            </a>
        </nav>
    </header>

    {{-- hero section--}}
    <section class="bg-white px-4 sm:px-6 py-16 sm:py-24 max-w-screen-xl mx-auto md:grid md:grid-cols-2 space-y-5">

        <div class="text-left">
            
            <div>
                <h5 class="text-lg font-medium text-gray-600 mb-3 md:mb-0">Hello there! 👋 I'm Ebiye</h5>

                <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl">
                    <span class="text-primary-300">Full-Stack</span> Web Developer
                </h1>

                <p class="mt-6 text-lg text-gray-700 sm:text-xl/relaxed">
                    I specialize in building 
                    <strong class="font-medium">secure</strong>, 
                    <strong class="font-medium">scalable</strong> 
                    web applications using modern technologies. With a focus on clean code and intuitive design.
                </p>
            </div>
            

            <div class="mt-8 flex flex-wrap gap-4 sm:mt-10">
                <a href="#contact" class="flex items-center rounded-lg bg-primary-300 px-6 py-4 font-medium text-primary-500 transition hover:scale-110 hover:rotate-2">
                    <span>Let's Build Something</span>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>

                <a href="#work" class="rounded-lg border border-gray-200 px-6 py-4 font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition hover:scale-110 hover:-rotate-2">
                    View My Work
                </a>
            </div>
        </div>

        <div class="overflow-hidden max-w-sm mx-auto ">
            <img src="{{ asset('images/bg-remove.png') }}" class="w-full rounded-xl" alt="Photo" />
        </div>

    </section>
    </body>
</html>
