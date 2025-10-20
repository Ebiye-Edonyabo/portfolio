<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ebiye-Edonyabo</title>

         <!-- Favicon section -->
        <link rel="icon" type="image/png" href="/favicon.png" sizes="96x96" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/b22f0a74ef.js" crossorigin="anonymous"></script>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-dotted">
     
        {{-- header --}}
        <header class="sticky z-50 top-3 px-2">
            <nav class="px-4 sm:px-6 py-1.5 max-w-screen-xl mx-auto flex justify-between items-center bg-gray-950/10 rounded-[10px]">

                {{-- logo --}}
                <a href="{{ url('/')}}">
                    <img src="{{ asset('images/logo.png')}}" class="h-8" alt="brand Logo" />
                </a>
            
                {{-- footer --}}
                <a href="#footer" class="text-tiny-size bg-white/80 rounded-full px-2 py-1.5 hover:bg-gray-950/5 transition-colors duration-300">
                    <i>Contact Me</i> 
                </a>
            </nav>
        </header>

        {{-- hero section--}}
        <section class="px-4 sm:px-6 py-16 sm:py-24 max-w-screen-xl mx-auto md:grid md:grid-cols-2 space-y-5">
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
                

                <div class="mt-8 flex flex-wrap items-center gap-4 sm:mt-10">
                    <a href="#contact" class="rounded-lg bg-gray-950/10 font-medium text-primary-500">
                        <span class="inline-block rounded-lg bg-primary-300 px-5 py-3 m-1 transition ease-in-out duration-400 hover:bg-transparent">Let's Build Something</span>
                    </a>

                    <a href="#work" class="rounded-lg bg-gray-950/10 font-medium text-gray-700">
                        <span class="inline-block bg-white/65 rounded-lg px-5 py-3 m-1 transition ease-in-out duration-400 hover:bg-transparent">View My Work</span> 
                    </a>
                </div>
            </div>

            <div class="overflow-hidden max-w-sm mx-auto ">
                <img src="{{ asset('images/bg-remove.png') }}" class="w-full rounded-xl" alt="Photo" />
            </div>
        </section>
       
        {{-- projects section --}}
        <x-projects />

        {{-- footer --}}
        <footer id="footer" class="w-full text-center mx-auto px-4 sm:px-6 max-w-lg py-6 space-y-4">
            <div class="space-x-4">
                <a href="https://wa.me/+2348130873408" target="_blank">
                    <i class="fa-brands fa-whatsapp text-primary-500 size-6"></i>
                </a>
                <a href="https://github.com/Ebiye-Edonyabo">
                    <i class="fa-brands fa-github text-primary-500 size-6"></i>
                </a>
                <a href="https://www.linkedin.com/in/ebiye-edonyabo">
                    <i class="fa-brands fa-linkedin-in text-primary-500 size-6"></i>
                </a>
                <a>
                    <i class="fa-brands fa-facebook text-primary-500 size-6"></i>
                </a>
            </div>

            <div class="space-x-4 flex flex-wrap justify-center">
                <span>
                    <i class="fa-solid fa-phone text-primary-500 size-6"></i>
                    <span>+2348130873408</span>
                </span>
                <span>
                    <i class="fa-solid fa-envelope text-primary-500 size-6"></i>
                    <span>edonyaboebiye11@gmail.com</span>
                </span>
            </div>
        </footer>
    </body>
</html>
