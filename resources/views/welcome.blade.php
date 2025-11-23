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
     
        @if(session('success'))
            <div class="bg-green-100 border border-primary-500/90 text-primary-300/90 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- header --}}
        <x-header />

        {{-- hero section--}}
        <x-hero />

        {{-- projects section --}}
        <x-projects />

      

        {{-- projects section --}}
        {{-- <x-skills /> --}}

        <x-experience />

        {{-- contact <meta> --}}
        <section>
            <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                    <div class="p-6 rounded-lg w-full bg-gray-500/10 border border-gray-500/30">
                        <h2 class="text-2xl font-bold text-gray-300 sm:text-3xl">Get In Touch</h2>

                        <p class="mt-4 text-pretty text-gray-300">
                            Have a project in mind or want to collaborate? I'd love to hear from you. Let's create something amazing together.
                        </p>

                        <div class="mt-6 space-y-3">
                            <x-contact-item-card item="+234 813-087-3408"> 
                                <x-slot:icon>  
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"></path>
                                    </svg>
                                </x-slot:icon>
                            </x-contact-item-card>

                            <x-contact-item-card item="edonyaboebiye11@gmail.com"> 
                                <x-slot:icon>  
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"></path>
                                    </svg>
                                </x-slot:icon>
                            </x-contact-item-card>

                            <x-contact-item-card item="Asaba, Delta State, Nigeria"> 
                                <x-slot:icon>  
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
                                    </svg>
                                </x-slot:icon>
                            </x-contact-item-card>
                        </div>
                    </div>

       
                    <form method="POST" action="/contact" class="space-y-4 rounded-lg w-full bg-gray-500/10 border border-gray-500/30 p-6">
                          @csrf
                        <x-text-input 
                            label="Name" 
                            model="name" 
                            placeholder="Enter your name"
                        />

                        <x-text-input 
                            label="Email" 
                            model="email" 
                            type="email" 
                            placeholder="Enter your email"
                        />

                        <x-textarea-input 
                            label="Message" 
                            model="message"
                            placeholder="Your message"
                        />

                        <button 
                            class="block w-full rounded-lg border border-primary-300/90 bg-primary-300/90 px-12 py-3 text-sm font-medium text-black transition-colors hover:bg-transparent hover:text-primary-300/90 " 
                            type="submit">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </section>

        {{-- <footer id="footer" class="bg-gray-500/10 ">
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
          
        </footer> --}}
        <footer id="footer" class="bg-gray-500/10 w-full">
            <section class="w-full mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 text-center">
                <h4 class="font-extrabold xl:text-8xl lg:text-7xl text-5xl md:text-6xl text-primary-500 tracking-wide w-full block">
                    Ebiye-Edonyabo
                </h4>
            </section>
        </footer>
 
        
    </body>
</html>
