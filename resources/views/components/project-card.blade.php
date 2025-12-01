<div class="max-w-sm w-full group flex flex-col justify-between gap-4 rounded-lg bg-gray-950/50 p-6 shadow-xl hover:shadow-primary-100/30 transition-all duration-300 hover:scale-105 hover:shadow-lg border border-primary-500/10">
    <div>
        <div class="w-full aspect-video bg-cover bg-center rounded-lg"
            style='background-image: url("{{ asset($image ) }}");'>
        </div>
        <div class="flex flex-col mt-4">
            <h3 class="text-lg font-bold text-white">{{ $title}}</h3>
            <div class="flex flex-wrap gap-2 my-1.5">
                {{ $technologies }}
            </div>
            <p class="text-sm text-gray-300">
                {{ $slot }}
            </p>
        </div>
    </div>
    <div class="mt-4 text-xs">
        <a target="_blank" href="{{ $route }}" class="flex items-center gap-1 py-1.5 px-3 text-white hover:bg-primary-500/95 bg-primary-300/60 rounded-[4px] w-fit font-bold transition ease-in-out duration-200">
          <i class="fa-solid fa-up-right-from-square"></i> <span class="px-0.5">Live</span>
        </a>
    </div>
</div>

     

     
