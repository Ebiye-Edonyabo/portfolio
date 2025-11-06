  <main class="bg-gray-500/10 py-16">
    <section class="font-display text-gray-800 max-w-screen-xl mx-auto">
        <span class="flex items-center px-4">
            <span class="shrink-0 pe-4 text-white text-4xl font-bold"> Projects </span>
            <span class="h-px flex-1 bg-gradient-to-l from-transparent to-primary-500"></span>
        </span>
        <div class="flex h-auto w-full flex-col">
            <main class="flex-grow">
                <section class="bg-background-light dark:bg-background-dark py-8 px-4">
                    <div class="flex flex-col gap-12">
                        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">

                            {{-- Card 1 --}}
                            <div class="group flex flex-col justify-between gap-4 rounded-lg bg-gray-950/50 p-6 shadow-xl hover:shadow-primary-100/30 transition-all duration-300 hover:scale-105 hover:shadow-lg border border-primary-500/10">
                                <div>
                                    <div class="w-full aspect-video bg-cover bg-center rounded-lg"
                                        style='background-image: url("{{ asset('images/mothompson.png') }}");'>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <h3 class="text-lg font-bold text-white">Mo Thompson Consulting</h3>
                                        <div class="flex flex-wrap gap-2 my-1.5">
                                            <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-gray-900/70 text-primary-300/90 border border-primary-500/20">Stack: <strong>TALL</strong></span>
                                        </div>
                                        <p class="text-sm text-gray-300">
                                            Consultancy platform empowering SMEs and enterprises with expert financial advisory, strategic solutions, and digital transformation. Supports grant management, innovation strategy, and mentorship with a free tier.
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-4 text-xs">
                                    <a target="_blank" href="https://www.mothompsonconsult.com/" class="flex items-center gap-1 text-primary-300/90 font-bold hover:underline">
                                        <i class="fa-solid fa-up-right-from-square"></i> Live
                                    </a>
                                </div>
                            </div>

                            {{-- Card 2 --}}
                            <div class="group flex flex-col justify-between gap-4 rounded-lg bg-gray-950/50 p-6 shadow-xl hover:shadow-primary-100/30 transition-all duration-300 hover:scale-105 hover:shadow-lg border border-primary-500/10">
                                <div>
                                    <div class="w-full aspect-video bg-cover bg-center rounded-lg"
                                        style='background-image: url("{{ asset('images/gracevillp.png') }}");'>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <h3 class="text-lg font-bold text-white">Graceville Group of Schools</h3>
                                        <div class="flex flex-wrap gap-2 my-1.5">
                                            <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-primary-500/10 text-primary-300/90 border border-primary-500/20">Stack: <strong>VILT</strong></span>
                                        </div>
                                        <p class="text-sm text-gray-300">
                                            A scalable multi-branch school management platform that streamlines academic and administrative operations. Includes dynamic form creation, academic and financial management, and a dedicated parent dashboard — all secured with role-based access.
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-4 text-xs">
                                    <a target="_blank" href="https://gracevilleschools.org/" class="flex items-center gap-1 text-primary-300/90  font-bold hover:underline">
                                        <i class="fa-solid fa-up-right-from-square"></i> Live
                                    </a>
                                </div>
                            </div>

                            {{-- Card 3 --}}
                            <div class="group flex flex-col justify-between gap-4 rounded-lg bg-gray-950/50 p-6 shadow-xl hover:shadow-primary-100/30 transition-all duration-300 hover:scale-105 hover:shadow-lg border border-primary-500/10">
                                <div>
                                    <div class="w-full aspect-video bg-cover bg-center rounded-lg"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDn5IydwD2_qKSo4nML1-a3RViWPQFfBvMZhDPb-dxDDjv02OP1MLZH8PlKLHhtwkIUqouUrT5duaIWk_fUg2jiRSDgQS1rjXjqEbkD7VWH6xtkx1ovjz_vo9jyGAGGeKq7Oocvp0RCkjO23fUuknZ3Qo7yLISdHCk3qy4-7QxC3AtXnWCVY4Ey90rW8RLEbFoSH-AOP6tTVDBpNdKlixAbkUW0LvvkAFX1kGxR-dzzhLwk34oEU2d3VdXIXKUE8nFwnS11wPeoEjE");'>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <h3 class="text-lg font-bold text-white">Secure Data Management</h3>
                                        <p class="text-sm text-gray-300">
                                            Ensure the safety and accessibility of your data with our robust security measures and cloud-based storage solutions.
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-4 text-xs">
                                    <a href="#" class="flex items-center gap-1 text-primary-300/90 font-bold hover:underline">
                                        <i class="fa-solid fa-up-right-from-square"></i> Learn More
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </main>
        </div>
    </section>
  </main>
