<div 
    x-data="{ message: '', show: false }"
    x-show="show"
    x-transition:enter="transform ease-out duration-300"
    x-transition:enter-start="translate-x-5 opacity-0 scale-95"
    x-transition:enter-end="translate-x-0 opacity-100 scale-100"
    x-transition:leave="transform ease-in duration-200"
    x-transition:leave-start="translate-x-0 opacity-100 scale-100"
    x-transition:leave-end="translate-x-5 opacity-0 scale-95"
    x-cloak
    class="fixed z-50 top-5 right-5 p-4 bg-gray-900/70 shadow-sm bg-secondary-300 border border-primary-500 rounded-md"
    @notification.window="
        message = $event.detail.message; 
        show = true; 
        setTimeout(() => show = false, 6000);
    "
>

    <div class="flex items-start gap-4">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-mt-0.5 size-6 text-primary-300">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>

        <div class="flex-1">
            <strong class="block leading-tight font-medium text-primary-300"> Success </strong>
            <p class="mt-0.5 text-sm text-primary-300" x-text="message"></p>
        </div>
    </div>

</div>
