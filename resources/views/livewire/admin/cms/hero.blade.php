<div class="max-w-2xl bg-[#121212] border border-[#1f1f1f] rounded-xl p-8 shadow-xl">
    <h3 class="text-base font-bold text-white tracking-wide uppercase mb-6 border-b border-[#1f1f1f] pb-3">Configure Landing Intro</h3>
    
    <form wire:submit="saveHero" class="space-y-5">
        <!-- Hello Subheading -->
        <x-admin.text-input label="Greeting Subtitle" model="form.hello" class="px-4 py-2.5 text-sm" />

        <!-- Main Title -->
        <x-admin.text-input label="Main Heading Role" model="form.title" class="px-4 py-2.5 text-sm" />

        <!-- Hero Image Path & Upload -->
        <div class="space-y-2">
            <x-admin.text-input label="Hero Image Path (Manual)" model="form.image_path" class="px-4 py-2.5 text-sm" placeholder="images/bg-remove.png" />
            
            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider block">Or Upload Image File</label>
                <input type="file" wire:model="form.image_file" accept=".png,.jpg,.jpeg,.webp"
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-4 py-2.5 rounded-lg text-sm outline-none focus:border-primary-300 file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[11px] file:font-semibold file:bg-[#1e2d0a] file:text-primary-300 hover:file:bg-[#1e2d0a]/80 transition-all cursor-pointer">
                @error('form.image_file') <span class="text-red-400 text-xs block mt-1">{{ $message }}</span> @enderror
            </div>

            @if ($form->image_file)
                <div class="mt-2 p-2 bg-[#171717] rounded-lg border border-[#1f1f1f] w-fit">
                    <span class="text-[10px] text-gray-400 block mb-1">Temporary Upload:</span>
                    <span class="text-xs text-white font-mono font-semibold">{{ $form->image_file->getClientOriginalName() }}</span>
                </div>
            @elseif ($form->image_path)
                <div class="mt-2 p-2 bg-[#171717] rounded-lg border border-[#1f1f1f] w-fit">
                    <span class="text-[10px] text-gray-400 block mb-1">Current Image:</span>
                    <img src="{{ asset($form->image_path) }}" class="h-16 w-16 object-cover rounded border border-[#1f1f1f]">
                </div>
            @endif
        </div>

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
