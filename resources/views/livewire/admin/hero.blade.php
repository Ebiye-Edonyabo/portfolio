<div class="max-w-2xl bg-[#121212] border border-[#1f1f1f] rounded-xl p-8 shadow-xl">
    <h3 class="text-base font-bold text-white tracking-wide uppercase mb-6 border-b border-[#1f1f1f] pb-3">Configure Landing Intro</h3>
    
    <form wire:submit="saveHero" class="space-y-5">
        <!-- Hello Subheading -->
        <div class="space-y-1.5">
            <label class="text-xs font-semibold uppercase tracking-wider text-gray-400">Greeting Subtitle</label>
            <input type="text" wire:model="form.hello" 
                class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-4 py-2.5 rounded-lg text-sm outline-none focus:border-primary-300 transition-all">
            @error('form.hello') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Main Title -->
        <div class="space-y-1.5">
            <label class="text-xs font-semibold uppercase tracking-wider text-gray-400">Main Heading Role</label>
            <input type="text" wire:model="form.title" 
                class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-4 py-2.5 rounded-lg text-sm outline-none focus:border-primary-300 transition-all">
            @error('form.title') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Description Bio -->
        <div class="space-y-1.5">
            <label class="text-xs font-semibold uppercase tracking-wider text-gray-400">Bio Description</label>
            <textarea rows="4" wire:model="form.description" 
                class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-4 py-2.5 rounded-lg text-sm outline-none focus:border-primary-300 transition-all resize-none"></textarea>
            @error('form.description') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Availability Badge -->
        <div class="space-y-1.5">
            <label class="text-xs font-semibold uppercase tracking-wider text-gray-400">Availability Status</label>
            <select wire:model="form.available" 
                class="select w-full bg-[#171717] border border-[#1f1f1f] text-white px-4 py-2.5 rounded-lg text-sm outline-none focus:border-primary-300 transition-all">
                <option value="true">Available (Green Glowing Dot)</option>
                <option value="false">Unavailable / Busy</option>
            </select>
            @error('form.available') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Action Submit -->
        <div class="pt-4 flex justify-end">
            <button type="submit" class="btn btn--primary py-2 px-6">
                Save Settings
            </button>
        </div>
    </form>
</div>
