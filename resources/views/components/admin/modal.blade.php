@props(['show', 'title', 'icon' => null, 'maxWidth' => 'sm'])

@php
    $maxWidthClass = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth];
@endphp

<div x-show="{{ $show }}"
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto">
    
    <!-- Backdrop -->
    <div x-show="{{ $show }}" x-transition.opacity class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" @click="{{ $show }} = false"></div>

    <!-- Modal Panel -->
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div x-show="{{ $show }}" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative transform overflow-hidden rounded-xl bg-[#0d0d0d] border border-[#1f1f1f] text-left shadow-xl transition-all sm:my-8 w-full {{ $maxWidthClass }}">
            
            <div class="px-5 pb-5 pt-5">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-base font-semibold leading-6 text-white">
                        @if($icon) <i class="{{ $icon }} text-primary-300 mr-2"></i> @endif
                        {{ $title }}
                    </h3>
                    <button @click="{{ $show }} = false" class="text-gray-400 hover:text-white transition-colors"><i class="fa-solid fa-xmark"></i></button>
                </div>
                
                <div class="space-y-4">
                    {{ $slot }}
                </div>
            </div>

            @isset($footer)
            <div class="bg-[#171717]/50 px-5 py-3 flex justify-end items-center border-t border-[#1f1f1f] gap-3">
                {{ $footer }}
            </div>
            @endisset
        </div>
    </div>
</div>
