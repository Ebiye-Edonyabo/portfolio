<div class="dashboard-grid gap-6">
    <!-- Left: Form -->
    <div class="col-span-4 bg-[#121212] border border-[#1f1f1f] rounded-xl p-6 h-fit">
        <h4 class="text-xs font-semibold uppercase tracking-wider text-white mb-4 border-b border-[#1f1f1f] pb-2">
            {{ $form->id ? 'Edit Experience Log' : 'Add Experience' }}
        </h4>
        <form wire:submit="saveExperience" class="space-y-4">
            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Date Period</label>
                <input type="text" wire:model="form.period" required
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all"
                    placeholder="Apr 2025 - Nov 2025">
                @error('form.period') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Role Title</label>
                <input type="text" wire:model="form.role" required
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all"
                    placeholder="Back-End Engineer">
                @error('form.role') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Company Name</label>
                <input type="text" wire:model="form.company" required
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all"
                    placeholder="Salient Software Solutions">
                @error('form.company') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Company Link URL</label>
                <input type="url" wire:model="form.company_url" 
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all"
                    placeholder="https://salientsolutions.tech">
                @error('form.company_url') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Location</label>
                <input type="text" wire:model="form.location" required
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all"
                    placeholder="Asaba, Delta State">
                @error('form.location') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Overview Description</label>
                <textarea rows="2" wire:model="form.description" 
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all resize-none"></textarea>
                @error('form.description') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Key Responsibilities (One per line)</label>
                <textarea rows="4" wire:model="form.responsibilities" 
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all resize-none"
                    placeholder="Integrated Slack notifications.&#10;Built invitations system."></textarea>
                @error('form.responsibilities') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Tech Stack Tags (Comma separated)</label>
                <input type="text" wire:model="form.technologies" 
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all"
                    placeholder="PHP, Laravel, MySQL">
                @error('form.technologies') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider block">Projects Built</label>
                
                <div class="space-y-2">
                    @foreach ($form->projects as $index => $project)
                        <div class="flex gap-2 items-center" wire:key="form-project-{{ $index }}">
                            <div class="grow grid grid-cols-2 gap-2">
                                <div>
                                    <input type="text" wire:model="form.projects.{{ $index }}.name" required
                                        class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all"
                                        placeholder="Project Name">
                                    @error("form.projects.{$index}.name") <span class="text-red-400 text-[10px] block mt-0.5">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <input type="url" wire:model="form.projects.{{ $index }}.url" required
                                        class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all"
                                        placeholder="Project URL">
                                    @error("form.projects.{$index}.url") <span class="text-red-400 text-[10px] block mt-0.5">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <button type="button" wire:click="removeProject({{ $index }})" 
                                class="text-red-400 hover:text-red-300 text-xs font-semibold p-2 cursor-pointer transition-all">
                                ✕
                            </button>
                        </div>
                    @endforeach
                </div>

                <button type="button" wire:click="addProject" 
                    class="btn btn--secondary py-1.5 px-3 text-xs flex items-center gap-1 mt-1 cursor-pointer">
                    + Add Project
                </button>
                @error('form.projects') <span class="text-red-400 text-xs block mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-2 pt-2">
                @if ($form->id)
                    <button type="button" wire:click="resetFormStates" class="btn btn--secondary py-1.5 px-4 text-xs cursor-pointer">
                        Cancel
                    </button>
                @endif
                <button type="submit" class="btn btn--primary py-1.5 px-4 text-xs cursor-pointer">
                    {{ $form->id ? 'Save Changes' : 'Add Experience' }}
                </button>
            </div>
        </form>
    </div>

    <!-- Right: Listing -->
    <div class="col-span-8 table-container">
        <div class="px-6 py-4 border-b border-[#1f1f1f]">
            <h3 class="text-xs font-bold text-white tracking-wide uppercase">Experience Timeline Log</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Role & Company</th>
                    <th>Period</th>
                    <th>Location</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($experiences as $ex)
                    <tr wire:key="exp-item-{{ $ex->id }}">
                        <td class="font-semibold text-white">
                            <div>{{ $ex->role }}</div>
                            <div class="text-xs text-gray-400 font-medium mt-0.5">{{ $ex->company }}</div>
                        </td>
                        <td class="text-gray-300 text-xs">{{ $ex->period }}</td>
                        <td class="text-gray-400 text-xs">{{ $ex->location }}</td>
                        <td class="text-right space-x-2">
                            <button wire:click="editExperience({{ $ex->id }})" class="text-primary-300 hover:text-primary-100 text-xs font-semibold transition-all cursor-pointer">
                                Edit
                            </button>
                            <button wire:click="deleteExperience({{ $ex->id }})" wire:confirm="Are you sure?" class="text-red-400 hover:text-red-300 text-xs font-semibold transition-all cursor-pointer">
                                Remove
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-8 text-gray-500">No experience logs stored.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
