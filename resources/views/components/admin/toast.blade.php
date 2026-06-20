<div x-data="{ show: false, message: '' }"
     x-on:notification.window="show = true; message = $event.detail.message; setTimeout(() => show = false, 3000)"
     x-show="show" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-4"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 translate-y-4"
     x-cloak
     class="fixed bottom-5 right-5 z-50 p-4 bg-[#1e2d0a] border border-primary-300 rounded-lg text-primary-100 text-xs font-semibold shadow-2xl flex items-center gap-2"
     style="display: none;">
     <i class="fa-solid fa-circle-check text-primary-300"></i>
     <span x-text="message"></span>
</div>
