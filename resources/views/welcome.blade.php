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
         @livewireStyles
    </head>
    <body class="bg-dotted">

        {{-- header --}}
        <x-header />

        <x-notification />

        {{-- hero section--}}
        <section class="px-4 sm:px-6 py-16 max-w-screen-xl mx-auto md:grid md:grid-cols-2 space-y-5 bg-dotted">
            <div class="text-left">
                <div>
                    <!-- Subheading -->
                    <h5 class="text-lg font-medium text-gray-300 mb-3 md:mb-0">Hello there! 👋 I'm<strong> Ebiye</strong></h5>

                    <!-- Main Heading -->
                    <h1 class="text-4xl font-bold text-white sm:text-5xl">
                        <span class="text-primary-300 font-bold">Full-Stack</span> Web Developer
                    </h1>

                    <!-- Description -->
                    <p class="mt-6 text-lg text-gray-200 sm:text-xl/relaxed">
                        A software developer with <strong class="font-medium text-white">2+ years</strong> 
                        experience in PHP and JavaScript, with expertise in modern frameworks such as
                        <strong class="font-medium text-white">Laravel</strong>, 
                        <strong class="font-medium text-white">Vue</strong>, and 
                        <strong class="font-medium text-white">Livewire</strong>.
                    </p>
                
                </div>

                <!-- Availability Badge -->
                <div class="mt-8 sm:mt-10">
                    <div class="flex items-center gap-3 rounded-full bg-gray-900/70 px-5 py-3 backdrop-blur-md shadow-sm border border-primary-500 w-fit">
                        <span class="relative flex h-3 w-3">
                        <span class="absolute inline-flex h-full w-full rounded-full bg-primary-300 opacity-75 animate-ping"></span>
                        <span class="relative inline-flex h-3 w-3 rounded-full bg-primary-300"></span>
                        </span>
                        <span class="text-sm sm:text-base font-medium text-primary-300">
                        Available for new projects
                        </span>
                    </div>
                </div>          
            </div>

            <!-- Image -->
            <div class="overflow-hidden max-w-sm mx-auto">
                <img src="{{ asset('images/bg-remove.png') }}" class="w-full rounded-xl shadow-xl border border-lime-900/50" alt="Ebiye" />
            </div>
        </section>

        {{-- Tools section --}}
         <section class="pb-16">
            <div class="max-w-6xl mx-auto px-6">

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 md:gap-4 my-10">
                    <div class="col-span-2 bg-black border-gray-600 border p-4 md:p-6 rounded-lg">
                        <div class="flex items-center justify-start gap-3">
                            <div>
                                <div class="">
                                    <span class="flex items-center">
                                        <span class="shrink-0 pe-4 text-white text-2xl font-bold"> Tools </span>
                                        <span class="h-px flex-1 bg-gradient-to-l from-transparent to-primary-500"></span>
                                    </span>
                                </div>
                                <h3 class="font-medium text-sm text-white">
                                    Building cool systems with
                                    <span class="text-primary-300 font-bold">powerful tools</span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <x-tool-card
                        asset="{{ asset('icons/HTML5.svg') }}"
                        title="HTML"
                     />

                    <x-tool-card
                        asset="{{ asset('icons/css.svg')  }}"
                        title="CSS"
                     />

                    <x-tool-card
                        asset="{{ asset('icons/Tailwind CSS.svg')  }}"
                        title="TailwindCss"
                     />

                    <x-tool-card
                        asset="{{ asset('icons/javascript.svg')  }}"
                        title="JavaScript"
                     />

                    <x-tool-card
                        asset="{{ asset('icons/Laravel.svg')  }}"
                        title="Laravel"
                     />

                    <x-tool-card
                        asset="{{ asset('icons/Livewire.svg')   }}"
                        title="Livewire"
                     />

                    <x-tool-card
                        asset="{{ asset('icons/Vue.js.svg')  }}"
                        title="VueJs"
                    />

                    <x-tool-card
                        asset="{{ asset('icons/Alpine.js.svg')  }}"
                        title="Alpine"
                    />

                    <x-tool-card
                        asset="{{ asset('icons/mysql.svg')  }}"
                        title="MySql"
                     />

                    <x-tool-card
                        asset="{{ asset('icons/Postman.svg')  }}"
                        title="Postman"
                     />
                </div>
            </div>
        </section>

        {{-- projects section --}}
        <main class="bg-gray-500/10 py-16">
            <section class="font-display text-gray-800 max-w-screen-xl mx-auto">
                <span class="flex items-center px-4">
                    <span class="shrink-0 pe-4 text-white text-4xl font-bold"> Projects </span>
                    <span class="h-px flex-1 bg-gradient-to-l from-transparent to-primary-500"></span>
                </span>
                <div class="flex h-auto w-full flex-col">
                    <main class="flex-grow">
                        <section class="bg-background-light dark:bg-background-dark py-8 px-4">
                            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">

                                {{-- Card 1 --}}
                                <x-project-card 
                                    image="images/mothompson.png"
                                    title="Mo Thompson Consulting"
                                    route="https://mothompsonconsult.com/"
                                    >
                                    <x-slot:technologies>
                                        <x-tag>Laravel</x-tag>
                                        <x-tag>Livewire</x-tag>
                                        <x-tag>Alpine</x-tag>
                                        <x-tag>Tailwind</x-tag>
                                    </x-slot:technologies>

                                    Consultancy platform empowering SMEs and enterprises with expert financial advisory, strategic solutions, and digital transformation. Supports grant management, innovation strategy, and mentorship with a free tier.
                                </x-project-card>

                                {{-- Card 2 --}}
                                <x-project-card 
                                    image="images/gracevillp.png"
                                    title="Graceville Group of Schools"
                                    route="https://gracevilleschools.org/"
                                    >

                                    <x-slot:technologies>
                                        <x-tag>Laravel</x-tag>
                                        <x-tag>Vue</x-tag>
                                        <x-tag>Inertia</x-tag>
                                        <x-tag>Tailwind</x-tag>
                                    </x-slot:technologies>
                        
                                    A scalable multi-branch school management platform that streamlines academic and 
                                    administrative operations. Includes dynamic form creation, academic and financial management, 
                                    and a dedicated parent dashboard — all secured with role-based access.
                                </x-project-card>

                                {{-- Card 3 --}}
                                <x-project-card 
                                    image="images/allsyntax.png"
                                    title="AllSyntax"
                                    route="https://allsyntax.gygital.com/"
                                    >
                                    
                                    <x-slot:technologies>
                                        <x-tag>Laravel</x-tag>
                                        <x-tag>Livewire</x-tag>
                                        <x-tag>Alpine</x-tag>
                                        <x-tag>Tailwind</x-tag>
                                    </x-slot:technologies>

                                    A modern training platform for aspiring software engineers, showcasing web and mobile development programs with mentorship and real-world projects.
                                </x-project-card>
                        

                                {{-- Card 4 --}}
                                <x-project-card 
                                    image="images/atriom.png"
                                    title="Atriom Technologies"
                                    route="https://atriomtechnologies.com/"
                                    >

                                    <x-slot:technologies>
                                        <x-tag>Laravel</x-tag>
                                        <x-tag>Livewire</x-tag>
                                        <x-tag>Alpine</x-tag>
                                        <x-tag>Tailwind</x-tag>
                                    </x-slot:technologies>

                                    A startup ecosystem enabler that collaborates with founders to build data-driven, innovative solutions — supporting entrepreneurs across Africa with mentorship, digital tools, and technology platforms.
                                </x-project-card>

                                <x-project-card 
                                    image="images/smartwear.png"
                                    title="SmartWear"
                                    route="https://smartwear.vercel.app/"
                                >
                                    <x-slot:technologies>
                                        <x-tag>PHP</x-tag>
                                        <x-tag>HTML</x-tag>
                                        <x-tag>CSS</x-tag>
                                    </x-slot:technologies>

                                    A static e-commerce platform built at the end of six-month web development training in 2023. This was my first website project.
                                </x-project-card>
                            </div>
                        </section>
                    </main>
                </div>
            </section>
        </main>

        {{-- experience section --}}
        <section class="py-16">
            <div class="max-w-6xl mx-auto px-6">
                <div class="">
                    <span class="flex items-center ">
                        <span class="h-px flex-1 bg-gradient-to-r from-transparent to-primary-500"></span>
                        <span class="shrink-0 px-4 text-white text-4xl font-bold">Experience</span>
                        <span class="h-px flex-1 bg-gradient-to-l from-transparent to-primary-500"></span>
                    </span>
                </div>

                <div class="grid md:grid-cols-2 my-10 bg-gray-500/10 border border-gray-500/30 rounded-lg">

                    {{-- Salient --}}
                    <x-experience-card 
                    period="Apr 2025 - Nov 2025" 
                    role="Back-End Engineer" 
                    company="Salient Software Solutions"
                    route="https://salientsolutions.tech" 
                    location="Asaba, Delta State"  
                    description="Contributed to the development and enhancement of two major company projects: 
                        AgoPay, a platform for simple and secure installment payments, and 
                        Agogo, an e-commerce platform offering flexible purchase options. ">

                        <x-key-responsibility-card> Integrated Slack for real-time notifications. </x-key-responsibility-card>
                        <x-key-responsibility-card> Built an invitation system managed by agents. </x-key-responsibility-card>
                        <x-key-responsibility-card> Developed KYC (Know Your Customer) processes for platform users. </x-key-responsibility-card>
                        <x-key-responsibility-card> Integrated third-party APIs for payment and KYC services. </x-key-responsibility-card>
                        <x-key-responsibility-card> Enabled multiple payment gateway integrations to allow easy switching during downtimes. </x-key-responsibility-card>
                        <x-key-responsibility-card> Optimized database queries to improve performance. </x-key-responsibility-card>
                        <x-key-responsibility-card> Tutored interns on the basics of web development and backend technologies using PHP and Laravel. </x-key-responsibility-card>


                        <x-slot:projects>
                        <x-tag route="https://www.agopay.africa/">Agopay</x-tag>
                        <x-tag route="https://agogo-africa.com/">Agogo</x-tag>
                        </x-slot:projects>

                        <x-slot:technologies>
                        <x-tag>Insomnia</x-tag>
                        <x-tag>PHP</x-tag>
                        <x-tag>Laravel</x-tag>
                        <x-tag>MySQL</x-tag>
                        <x-tag>QOREID API</x-tag>
                        <x-tag>PayStack/FlutterWave API</x-tag>
                        </x-slot:technologies>

                    </x-experience-card>
        
                    {{-- Gygital --}}
                    <x-experience-card 
                        period="Aug 2024 - Apr 2025" 
                        role="Full-Stack Web Developer" 
                        company="Gygital" 
                        route="https://gygital.com/" 
                        location="Asaba, Delta State"  
                        description="Collaborated with the team lead to deliver full-stack 
                            solutions for company and clients using modern frameworks and best practices.">

                        <x-key-responsibility-card> Built a software-engineering training platform.</x-key-responsibility-card>
                        <x-key-responsibility-card> Developed a startup-support and tech-solutions ecosystem platform. </x-key-responsibility-card>
                        <x-key-responsibility-card> Built a strategic consulting platform offering grant management, business registration, and digital-solution services. </x-key-responsibility-card>
                        <x-key-responsibility-card> Converted a multi-vendor e-commerce platform from separate Laravel backend and Vue frontend projects into a unified monolithic Laravel and Livewire application. </x-key-responsibility-card>
                        <x-key-responsibility-card> Integrated payment-system APIs for seamless online transactions. </x-key-responsibility-card>

                        <x-slot:projects>
                        <x-tag route="https://britonkay.ng/">BritonKay</x-tag>
                        <x-tag route="https://allsyntax.gygital.com/">AllSyntax</x-tag>
                        <x-tag route="https://atriomtechnologies.com/">Atriom Technologies</x-tag>
                        <x-tag route="https://mothompsonconsult.com/">Mo Thompson Consulting</x-tag>
                        </x-slot:projects>

                        <x-slot:technologies>
                        <x-tag>PHP</x-tag>
                        <x-tag>Laravel</x-tag>
                        <x-tag>Livewire</x-tag>
                        <x-tag>Blade</x-tag>
                        <x-tag>MySQL</x-tag>
                        <x-tag>PayStack</x-tag>
                        </x-slot:technologies>

                    </x-experience-card>
                
                </div>
            </div>
        </section>

        {{-- contact --}}
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

                            <x-contact-item-card item="Respond within 24hrs"> 
                                <x-slot:icon>  
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>

                                </x-slot:icon>
                            </x-contact-item-card>
                        </div>
                    </div>

                   <livewire:contact-form />

                </div>
            </div>
        </section>

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
