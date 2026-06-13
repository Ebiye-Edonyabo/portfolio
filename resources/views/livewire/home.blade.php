<div>
    {{-- hero section--}}
    <section class="px-4 sm:px-6 py-16 max-w-screen-xl mx-auto md:grid md:grid-cols-2 space-y-5 bg-dotted">
        <div class="text-left">
            <div>
                <!-- Subheading -->
                <h5 class="text-lg font-medium text-gray-300 mb-3 md:mb-0">{!! $settings['hello'] ?? 'Hello there! 👋 I\'m<strong> Ebiye</strong>' !!}</h5>

                <!-- Main Heading -->
                @php
                    $title = $settings['title'] ?? 'Full-Stack Web Developer';
                    $words = explode(' ', $title);
                    $firstWord = array_shift($words);
                    $restOfTitle = implode(' ', $words);
                @endphp
                <h1 class="text-4xl font-bold text-white sm:text-5xl">
                    <span class="text-primary-300 font-bold">{{ $firstWord }}</span> {{ $restOfTitle }}
                </h1>

                <!-- Description -->
                <p class="mt-6 text-lg text-gray-200 sm:text-xl/relaxed">
                    {!! $settings['description'] ?? 'A software developer with <strong class="font-medium text-white">2+ years</strong> experience...' !!}
                </p>
            
            </div>

            <!-- Availability Badge -->
            <div class="mt-8 sm:mt-10">
                @if (($settings['available'] ?? 'true') === 'true')
                    <div class="flex items-center gap-3 rounded-full bg-gray-900/70 px-5 py-3 backdrop-blur-md shadow-sm border border-primary-500 w-fit">
                        <span class="relative flex h-3 w-3">
                        <span class="absolute inline-flex h-full w-full rounded-full bg-primary-300 opacity-75 animate-ping"></span>
                        <span class="relative inline-flex h-3 w-3 rounded-full bg-primary-300"></span>
                        </span>
                        <span class="text-sm sm:text-base font-medium text-primary-300">
                        Available for new projects
                        </span>
                    </div>
                @else
                    <div class="flex items-center gap-3 rounded-full bg-gray-900/70 px-5 py-3 backdrop-blur-md shadow-sm border border-red-500/50 w-fit">
                        <span class="relative flex h-3 w-3">
                        <span class="relative inline-flex h-3 w-3 rounded-full bg-red-500"></span>
                        </span>
                        <span class="text-sm sm:text-base font-medium text-red-400">
                        Currently unavailable
                        </span>
                    </div>
                @endif
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

                @foreach ($tools as $tool)
                    <x-tool-card
                        wire:key="tool-{{ $tool->id }}"
                        asset="{{ asset($tool->logo_path) }}"
                        title="{{ $tool->name }}"
                     />
                @endforeach
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
                            @foreach ($projects as $project)
                                <x-project-card 
                                    wire:key="project-{{ $project->id }}"
                                    image="{{ $project->image_path }}"
                                    title="{{ $project->title }}"
                                    route="{{ $project->route_url }}"
                                    >
                                    <x-slot:technologies>
                                        @foreach ($project->technologies ?? [] as $tech)
                                            <x-tag>{{ $tech }}</x-tag>
                                        @endforeach
                                    </x-slot:technologies>

                                    {{ $project->description }}
                                </x-project-card>
                            @endforeach
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
                    <span class="shrink-0 px-4 text-white text-4xl font-bold">Experience</span>
                </span>
            </div>

            <div class="grid md:grid-cols-2 my-10 bg-gray-500/10 border border-gray-500/30 rounded-lg">
                @foreach ($experiences as $ex)
                    <x-experience-card 
                        wire:key="experience-{{ $ex->id }}"
                        period="{{ $ex->period }}" 
                        role="{{ $ex->role }}" 
                        company="{{ $ex->company }}"
                        route="{{ $ex->company_url }}" 
                        location="{{ $ex->location }}"  
                        description="{{ $ex->description }}"
                    >
                        @foreach ($ex->responsibilities ?? [] as $resp)
                            <x-key-responsibility-card>{{ $resp }}</x-key-responsibility-card>
                        @endforeach

                        @if ($ex->company === 'Salient Software Solutions')
                            <x-slot:projects>
                                <x-tag route="https://www.agopay.africa/">Agopay</x-tag>
                                <x-tag route="https://agogo-africa.com/">Agogo</x-tag>
                            </x-slot:projects>
                        @elseif ($ex->company === 'Gygital')
                            <x-slot:projects>
                                <x-tag route="https://britonkay.ng/">BritonKay</x-tag>
                                <x-tag route="https://allsyntax.gygital.com/">AllSyntax</x-tag>
                                <x-tag route="https://atriomtechnologies.com/">Atriom Technologies</x-tag>
                                <x-tag route="https://mothompsonconsult.com/">Mo Thompson Consulting</x-tag>
                            </x-slot:projects>
                        @endif

                        <x-slot:technologies>
                            @foreach ($ex->technologies ?? [] as $tech)
                                <x-tag>{{ $tech }}</x-tag>
                            @endforeach
                        </x-slot:technologies>
                    </x-experience-card>
                @endforeach
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
</div>
