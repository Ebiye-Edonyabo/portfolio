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
        <x-header />

        {{-- hero section--}}
        <x-hero />

        {{-- projects section --}}
        <x-projects />

      

        {{-- projects section --}}
        {{-- <x-skills /> --}}

        <x-experience />

        {{-- footer --}}
        <footer id="footer" class="bg-gray-500/10 ">
            <section class="w-full text-center mx-auto px-4 sm:px-6 max-w-lg py-6 space-y-4">
                <div class="space-x-4">
                    <a href="https://wa.me/+2348130873408" target="_blank">
                        <i class="fa-brands fa-whatsapp text-primary-300/90 size-6"></i>
                    </a>
                    <a href="https://github.com/Ebiye-Edonyabo">
                        <i class="fa-brands fa-github text-primary-300/90 size-6"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/ebiye-edonyabo">
                        <i class="fa-brands fa-linkedin-in text-primary-300/90 size-6"></i>
                    </a>
                    <a>
                        <i class="fa-brands fa-facebook text-primary-300/90 size-6"></i>
                    </a>
                </div>

                <div class="space-x-4 flex flex-wrap justify-center">
                    <span>
                        <i class="fa-solid fa-phone text-primary-300/90 size-6"></i>
                        <span class="text-white/90">+2348130873408</span>
                    </span>
                    <span>
                        <i class="fa-solid fa-envelope text-primary-300/90 size-6"></i>
                        <span class="text-white/90">edonyaboebiye11@gmail.com</span>
                    </span>
                </div>
            </section>
          
        </footer>
    </body>
</html>
