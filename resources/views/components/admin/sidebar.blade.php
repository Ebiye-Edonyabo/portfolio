<aside class="sidebar w-65 fixed inset-y-0 left-0 bg-[#0d0d0d] border-r border-[#1f1f1f] flex flex-col z-40 transform transition-transform duration-200 lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    <!-- Logo / Brand Header -->
    <div class="h-15 border-b border-[#1f1f1f] flex items-center justify-between px-6">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo_new1.png') }}" class="h-6 w-auto" alt="Logo">
            <span class="text-white font-semibold text-base tracking-tight">Ebiye-Edonyabo</span>
        </div>
        <!-- Mobile Close Button -->
        <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-white cursor-pointer transition-colors p-1" type="button">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 py-6 px-4 space-y-1.5 overflow-y-auto">
        <!-- Overview -->
        <a href="{{ route('admin.dashboard') }}"
            class="w-full flex items-center px-4 py-2.5 rounded-lg border-l-3 text-left gap-3 text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'border-primary-300 text-white bg-[#1e2d0a]' : 'border-transparent text-gray-300 hover:bg-[#171717] hover:text-white' }}">
            <i class="fa-solid fa-chart-line text-base {{ request()->routeIs('admin.dashboard') ? 'text-primary-300' : 'text-gray-400' }}"></i>
            Dashboard
        </a>

        <!-- CMS Parent (with toggle) -->
        <div x-data="{ cmsOpen: @js(request()->routeIs(['admin.hero', 'admin.tools', 'admin.projects', 'admin.experiences'])) }">
            <button @click="cmsOpen = !cmsOpen" type="button"
                class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg text-left text-sm font-medium text-gray-300 hover:bg-[#171717] hover:text-white transition-all">
                <span class="flex items-center gap-3">
                    <i class="fa-solid fa-sliders text-base text-gray-400"></i>
                    CMS Manager
                </span>
                <i class="fa-solid text-xs text-gray-500 transition-transform duration-200" :class="cmsOpen ? 'fa-chevron-down' : 'fa-chevron-right'"></i>
            </button>

            <!-- Sub-Links -->
            <div x-show="cmsOpen" x-transition x-cloak class="mt-1 ml-4 pl-3 border-l border-[#1f1f1f] space-y-1">
                <!-- Hero Section -->
                <a href="{{ route('admin.hero') }}"
                    class="w-full flex items-center px-3 py-2 rounded-md text-left text-xs font-semibold transition-all {{ request()->routeIs('admin.hero') ? 'text-primary-300 bg-[#1e2d0a]/50' : 'text-gray-400 hover:text-white hover:bg-[#171717]' }}">
                    Hero Section
                </a>
                <!-- Tools -->
                <a href="{{ route('admin.tools') }}"
                    class="w-full flex items-center px-3 py-2 rounded-md text-left text-xs font-semibold transition-all {{ request()->routeIs('admin.tools') ? 'text-primary-300 bg-[#1e2d0a]/50' : 'text-gray-400 hover:text-white hover:bg-[#171717]' }}">
                    Tools Grid
                </a>
                <!-- Projects -->
                <a href="{{ route('admin.projects') }}"
                    class="w-full flex items-center px-3 py-2 rounded-md text-left text-xs font-semibold transition-all {{ request()->routeIs('admin.projects') ? 'text-primary-300 bg-[#1e2d0a]/50' : 'text-gray-400 hover:text-white hover:bg-[#171717]' }}">
                    Projects List
                </a>
                <!-- Experience -->
                <a href="{{ route('admin.experiences') }}"
                    class="w-full flex items-center px-3 py-2 rounded-md text-left text-xs font-semibold transition-all {{ request()->routeIs('admin.experiences') ? 'text-primary-300 bg-[#1e2d0a]/50' : 'text-gray-400 hover:text-white hover:bg-[#171717]' }}">
                    Experience Timeline
                </a>
            </div>
        </div>

        <!-- Finances Parent (with toggle) -->
        <div x-data="{ financesOpen: @js(request()->routeIs(['admin.saving_plans', 'admin.savings', 'admin.allocations', 'admin.transactions'])) }">
            <button @click="financesOpen = !financesOpen" type="button"
                class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg text-left text-sm font-medium text-gray-300 hover:bg-[#171717] hover:text-white transition-all">
                <span class="flex items-center gap-3">
                    <i class="fa-solid fa-wallet text-base text-gray-400"></i>
                    Finances
                </span>
                <i class="fa-solid text-xs text-gray-500 transition-transform duration-200" :class="financesOpen ? 'fa-chevron-down' : 'fa-chevron-right'"></i>
            </button>

            <!-- Sub-Links -->
            <div x-show="financesOpen" x-transition x-cloak class="mt-1 ml-4 pl-3 border-l border-[#1f1f1f] space-y-1">
                <!-- Allocations -->
                <a href="{{ route('admin.allocations') }}"
                    class="w-full flex items-center px-3 py-2 rounded-md text-left text-xs font-semibold transition-all {{ request()->routeIs('admin.allocations') ? 'text-primary-300 bg-[#1e2d0a]/50' : 'text-gray-400 hover:text-white hover:bg-[#171717]' }}">
                    Allocations
                </a>
                <!-- Savings -->
                <a href="{{ route('admin.savings') }}"
                    class="w-full flex items-center px-3 py-2 rounded-md text-left text-xs font-semibold transition-all {{ request()->routeIs('admin.savings') ? 'text-primary-300 bg-[#1e2d0a]/50' : 'text-gray-400 hover:text-white hover:bg-[#171717]' }}">
                    Savings
                </a>
                <!-- Transactions -->
                <a href="{{ route('admin.transactions') }}"
                    class="w-full flex items-center px-3 py-2 rounded-md text-left text-xs font-semibold transition-all {{ request()->routeIs('admin.transactions') ? 'text-primary-300 bg-[#1e2d0a]/50' : 'text-gray-400 hover:text-white hover:bg-[#171717]' }}">
                    Transactions
                </a>
                <!-- Saving Plans -->
                <a href="{{ route('admin.saving_plans') }}"
                    class="w-full flex items-center px-3 py-2 rounded-md text-left text-xs font-semibold transition-all {{ request()->routeIs('admin.saving_plans') ? 'text-primary-300 bg-[#1e2d0a]/50' : 'text-gray-400 hover:text-white hover:bg-[#171717]' }}">
                    Saving Plans
                </a>
            </div>
        </div>

        <!-- Messages -->
        <a href="{{ route('admin.messages') }}"
            class="w-full flex items-center px-4 py-2.5 rounded-lg border-l-3 text-left gap-3 text-sm font-medium transition-all {{ request()->routeIs('admin.messages') ? 'border-primary-300 text-white bg-[#1e2d0a]' : 'border-transparent text-gray-300 hover:bg-[#171717] hover:text-white' }}">
            <i class="fa-solid fa-envelope text-base {{ request()->routeIs('admin.messages') ? 'text-primary-300' : 'text-gray-400' }}"></i>
            Messages Logs
        </a>
    </nav>

    <!-- Sidebar Footer (Logout) -->
    <div class="p-4 border-t border-[#1f1f1f]">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center px-4 py-2.5 rounded-lg text-red-400 hover:bg-red-500/10 hover:text-red-300 text-sm font-medium gap-3 transition-all text-left cursor-pointer">
                <i class="fa-solid fa-sign-out text-base"></i>
                Sign Out
            </button>
        </form>
    </div>
</aside>
