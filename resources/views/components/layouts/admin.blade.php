<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Ebiye-Edonyabo' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        
        <!-- FontAwesome -->
        <script src="https://kit.fontawesome.com/b22f0a74ef.js" crossorigin="anonymous"></script>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-dotted min-h-screen text-gray-300 antialiased font-sans" x-data="{ sidebarOpen: false }">
        @auth
            <div class="flex h-screen overflow-hidden bg-dotted relative">
                <!-- Mobile Sidebar Backdrop Overlay -->
                <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/60 z-30 lg:hidden" x-cloak></div>

                <!-- 1. Sidebar -->
                <x-admin.sidebar />

                <!-- 2. Main Content Wrapper -->
                <div class="flex-1 lg:pl-65 pl-0 flex flex-col h-full overflow-hidden">
                    <!-- Top Bar -->
                    <header class="topbar h-15 border-b border-[#1f1f1f] bg-[#0d0d0d] flex items-center justify-between px-8 z-20">
                        <div class="flex items-center gap-3">
                            <!-- Hamburger Icon for Mobile Menu -->
                            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-white cursor-pointer hover:text-primary-300 transition-colors p-1" type="button">
                                <i class="fa-solid fa-bars text-lg"></i>
                            </button>
                            <h2 class="text-sm font-semibold text-white uppercase tracking-wider">
                                {{ $title ?? 'Admin Dashboard' }}
                            </h2>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-xs text-gray-400">Welcome, {{ Auth::user()->name }}</span>
                            <div class="w-8 h-8 rounded-full border border-primary-500 bg-primary-500/10 flex items-center justify-center text-primary-300 font-bold text-xs">
                                AD
                            </div>
                        </div>
                    </header>

                    <!-- Main Content Canvas -->
                    <main class="flex-1 p-8 overflow-y-auto">
                        <!-- Global Flash Notification -->
                        <div x-data="{ show: false, message: '' }"
                             x-on:notification.window="show = true; message = $event.detail.message; setTimeout(() => show = false, 3000)"
                             x-show="show" x-cloak
                             class="fixed bottom-5 right-5 z-50 p-4 bg-[#1e2d0a] border border-primary-300 rounded-lg text-primary-100 text-xs font-semibold shadow-2xl transition-all"
                             style="display: none;">
                             <i class="fa-solid fa-circle-check text-primary-300 mr-2"></i>
                             <span x-text="message"></span>
                        </div>

                        {{ $slot }}
                    </main>
                </div>
            </div>
        @else
            {{ $slot }}
        @endauth

        @livewireScripts
    </body>
</html>
