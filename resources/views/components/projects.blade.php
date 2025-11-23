  <main class="bg-gray-500/10 py-16">
    <section class="font-display text-gray-800 max-w-screen-xl mx-auto">
        <span class="flex items-center px-4">
            <span class="shrink-0 pe-4 text-white text-4xl font-bold"> Projects </span>
            <span class="h-px flex-1 bg-gradient-to-l from-transparent to-primary-500"></span>
        </span>
        <div class="flex h-auto w-full flex-col">
            <main class="flex-grow">
                <section class="bg-background-light dark:bg-background-dark py-8 px-4">
                    {{-- <div class="flex flex-col gap-12"> --}}
                        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">

                            {{-- Card 1 --}}
                            <x-project-card 
                                image="images/allsyntax.png"
                                title="AllSyntax"
                                stack="TALL"
                                route="https://allsyntax.gygital.com/"
                                >
                    
                                A modern training platform for aspiring software engineers, showcasing web and mobile development programs with mentorship and real-world projects.
                            </x-project-card>

                            {{-- Card 2 --}}
                            <x-project-card 
                                image="images/gracevillp.png"
                                title="Graceville Group of Schools"
                                stack="VILT"
                                route="https://gracevilleschools.org/"
                                >
                    
                                A scalable multi-branch school management platform that streamlines academic and 
                                administrative operations. Includes dynamic form creation, academic and financial management, 
                                and a dedicated parent dashboard — all secured with role-based access.
                            </x-project-card>

                            {{-- Card 3 --}}
                            <x-project-card 
                                image="images/mothompson.png"
                                title="Mo Thompson Consulting"
                                stack="TALL"
                                route="https://mothompsonconsult.com/"
                                >
                                
                                Consultancy platform empowering SMEs and enterprises with expert financial advisory, strategic solutions, and digital transformation. Supports grant management, innovation strategy, and mentorship with a free tier.
                            </x-project-card>
                      

                            {{-- Card 4 --}}
                            <x-project-card 
                                image="images/atriom.png"
                                title="Atriom Technologies"
                                stack="TALL"
                                route="https://atriomtechnologies.com/"
                                >
                    
                                A startup ecosystem enabler that collaborates with founders to build data-driven, innovative solutions — supporting entrepreneurs across Africa with mentorship, digital tools, and technology platforms.
                            </x-project-card>

                            <x-project-card 
                                image="images/smartwear.png"
                                title="SmartWear"
                                stack="PHP, CSS & HTML"
                                route="https://smartwear.vercel.app/"
                            >
                                A static e-commerce platform built during my six-month web development program at Rolof Academy in 2023. This was my first website project.
                            </x-project-card>

                            

                        </div>
                    {{-- </div> --}}
                </section>
            </main>
        </div>
    </section>
  </main>
