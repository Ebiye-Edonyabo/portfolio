<div>
     <form wire:submit.prevent="save" 
        class="space-y-4 rounded-lg w-full bg-gray-500/10 border border-gray-500/30 p-6">

        <x-text-input 
            label="Name" 
            model="name" 
            placeholder="Enter your name"
        />

        <x-text-input 
            label="Email" 
            model="email" 
            type="email" 
            placeholder="Enter your email"
        />

        <x-textarea-input 
            label="Message" 
            model="message"
            placeholder="Your message"
        />

        <button 
            class="block w-full cursor-pointer rounded-lg border border-primary-300/90 bg-primary-300/90 px-12 py-3 text-sm font-medium text-black transition-colors hover:bg-transparent hover:text-primary-300/90 " 
            type="submit">
            Send Message
        </button>
    </form>
</div>
