<div class="max-w-2xl bg-[#121212] border border-[#1f1f1f] rounded-xl p-8 shadow-xl">
    <h3 class="text-base font-bold text-white tracking-wide uppercase mb-6 border-b border-[#1f1f1f] pb-3">Configure Landing Intro</h3>
    
    <form wire:submit="saveHero" class="space-y-5">
        <!-- Hello Subheading -->
        <x-admin.text-input label="Greeting Subtitle" model="form.hello" class="px-4 py-2.5 text-sm" />

        <!-- Main Title -->
        <x-admin.text-input label="Main Heading Role" model="form.title" class="px-4 py-2.5 text-sm" />

        <!-- Hero Image Path -->
        <x-admin.text-input label="Hero Image Path" model="form.image_path" class="px-4 py-2.5 text-sm" placeholder="images/bg-remove.png" />

        <!-- Description Bio -->
        <x-admin.textarea-input label="Bio Description" model="form.description" class="px-4 py-2.5 text-sm" rows="4" />

        <!-- Availability Badge -->
        <x-admin.dropdown-input label="Availability Status" model="form.available" class="select px-4 py-2.5 text-sm">
            <option value="true">Available (Green Glowing Dot)</option>
            <option value="false">Unavailable / Busy</option>
        </x-admin.dropdown-input>

        <!-- Action Submit -->
        <div class="pt-4 flex justify-end">
            <button type="submit" class="btn btn--primary py-2 px-6">
                Save Settings
            </button>
        </div>
    </form>
</div>
