<header class="sticky z-50 top-3 px-2">
    <nav class="px-4 sm:px-6 py-1.5 max-w-2xl mx-auto flex justify-between items-center bg-gray-950/30 rounded-[10px] border border-primary-300/10">
        
        {{-- Logo --}}
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" class="h-8" alt="Brand Logo" />
        </a>

        {{-- Contact Button --}}
        <a href="#footer" class="text-tiny-size bg-white/10 text-primary-300/90 hover:bg-primary-300/5 hover:border hover:border-primary-500 hover:text-white rounded-full px-3 py-1.5 transition-colors duration-300">
            <i>Contact Me</i> 
        </a>
    </nav>
</header>