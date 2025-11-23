<div class="p-10 border-b md:border-b md:border-r border-primary-500">
    <p class="text-sm font-medium text-primary-300/90 mb-1">{{ $period }}</p>
    <h3 class="text-xl font-semibold text-white">{{ $role }}</h3>
    <p class="text-md text-gray-400 mb-3 flex items-center gap-1">
    <a href="{{ $route }}" target="_blank" class="font-medium hover:underline inline-flex items-center gap-1">
        {{ $company }}
        <i class="fa-solid fa-up-right-from-square text-[11px]"></i>
    </a>
    <span class="text-sm text-gray-500">· {{ $location }}</span>
    </p>

    <p class="text-gray-300 text-sm leading-relaxed mb-4">
    {{ $description  }}
    </p>

    {{-- Key Responsibilities --}}
    <div class="mt-4">
    <h4 class="text-sm font-semibold text-white/90 mb-2 uppercase tracking-wide">Key Responsibilities</h4>
    <ul class="space-y-2 text-sm text-gray-600">
        
        {{ $slot }}

    </ul>
    </div>

    <div class="space-y-2">
        {{-- Key Projects --}}
        <div>
            @isset($projects)
                <div class="mt-6 space-x-2">
                    <h4 class="text-sm font-semibold text-white/90 mb-2 uppercase tracking-wide">Key Projects</h4>
                    {{ $projects }}
                </div>
            @endisset
        </div>

        {{-- Technologies Used --}}
        <div>
            @isset($technologies)
                <div class="mt-6 space-x-2">
                    <h4 class="text-sm font-semibold text-white/90 mb-2 uppercase tracking-wide">Technologies Used</h4>
                    {{ $technologies }}
                </div>
            @endisset
        </div>
    </div>
  

</div>