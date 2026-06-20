<div 
    x-data="{ 
        show: false, 
        title: '', 
        message: '', 
        action: null 
    }"
    @open-confirmation-modal.window="
        show = true; 
        title = $event.detail.title;
        message = $event.detail.message;
        action = $event.detail.action;
    "
    x-show="show"
    x-cloak
    style="display: none;"
    class="fixed inset-0 z-50 overflow-y-auto"
>
    <!-- Backdrop -->
    <div 
        x-show="show" 
        x-transition.opacity 
        class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"
    ></div>

    <!-- Modal Panel -->
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div 
            x-show="show" 
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            @click.outside="show = false"
            class="relative transform overflow-hidden rounded-xl bg-[#0d0d0d] border border-[#1f1f1f] text-center shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm"
        >
            <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4 flex flex-col items-center">
                <!-- Icon -->
                <div class="mx-auto flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-red-400/10 mb-4">
                    <i class="fa-solid fa-triangle-exclamation text-red-400 text-sm"></i>
                </div>
                
                <h3 class="text-base font-semibold leading-6 text-white mb-2" x-text="title"></h3>
                <p class="text-sm text-gray-400" x-text="message"></p>
            </div>
            
            <div class="px-4 pb-6 pt-2 sm:px-6 flex flex-row gap-3">
                <button 
                    type="button" 
                    @click="show = false"
                    class="flex-1 justify-center rounded-md bg-[#171717] border border-[#1f1f1f] px-3 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#2a2a2a]"
                >
                    Cancel
                </button>
                <button 
                    type="button" 
                    @click="$wire.call(action.method, ...action.params); show = false"
                    class="flex-1 justify-center rounded-md bg-red-500 px-3 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-400"
                >
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>
