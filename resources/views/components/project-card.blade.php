<div class="max-w-sm w-full group flex flex-col justify-between gap-4 rounded-lg bg-gray-950/50 p-6 shadow-xl hover:shadow-primary-100/30 transition-all duration-300 hover:scale-105 hover:shadow-lg border border-primary-500/10">
    <div>
        <div class="w-full aspect-video bg-cover bg-center rounded-lg"
            style='background-image: url("{{ asset($image ) }}");'>
        </div>
        <div class="flex flex-col mt-4">
            <h3 class="text-lg font-bold text-white">{{ $title}}</h3>
            <div class="flex flex-wrap gap-2 my-1.5">
                <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-gray-900/70 text-primary-300/90 border border-primary-500/20">Stack: <strong>{{ $stack }}</strong></span>
            </div>
            <p class="text-sm text-gray-300">
                {{ $slot }}
            </p>
        </div>
    </div>
    <div class="mt-4 text-xs">
        <a target="_blank" href="{{ $route }}" class="flex items-center gap-1 text-primary-300/90 font-bold hover:underline">
            <i class="fa-solid fa-up-right-from-square"></i> Live
        </a>
    </div>
</div>

     

     
