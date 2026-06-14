<div class="dashboard-grid gap-6">
    <!-- Left: Form -->
    <div class="col-span-12 lg:col-span-4 bg-[#121212] border border-[#1f1f1f] rounded-xl p-6 h-fit">
        <h4 class="text-xs font-semibold uppercase tracking-wider text-white mb-4 border-b border-[#1f1f1f] pb-2">
            {{ $form->id ? 'Edit Project Specs' : 'Publish Project' }}
        </h4>
        <form wire:submit="saveProject" class="space-y-4">
            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Project Title</label>
                <input type="text" wire:model="form.title" required
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all">
                @error('form.title') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Description</label>
                <textarea rows="3" wire:model="form.description" required
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all resize-none"></textarea>
                @error('form.description') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Thumbnail Image Path</label>
                <input type="text" wire:model="form.image_path" 
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all"
                    placeholder="images/allsyntax.png">
                @error('form.image_path') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Direct Routing URL</label>
                <input type="url" wire:model="form.route_url" 
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all"
                    placeholder="https://example.com">
                @error('form.route_url') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Technologies (Comma separated)</label>
                <input type="text" wire:model="form.technologies" 
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all"
                    placeholder="Laravel, Vue, Tailwind">
                @error('form.technologies') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Status -->
            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Status</label>
                <select wire:model="form.status" required
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all">
                    @foreach ($statusOptions as $option)
                        <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                    @endforeach
                </select>
                @error('form.status') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-2 pt-2">
                @if ($form->id)
                    <button type="button" wire:click="resetFormStates" class="btn btn--secondary py-1.5 px-4 text-xs cursor-pointer">
                        Cancel
                    </button>
                @endif
                <button type="submit" class="btn btn--primary py-1.5 px-4 text-xs cursor-pointer">
                    {{ $form->id ? 'Save Changes' : 'Publish' }}
                </button>
            </div>
        </form>
    </div>

    <!-- Right: Listing -->
    <div class="col-span-12 lg:col-span-8 table-container">
        <div class="px-6 py-4 border-b border-[#1f1f1f]">
            <h3 class="text-xs font-bold text-white tracking-wide uppercase">Active Projects List</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Stack Tags</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $p)
                    <tr wire:key="project-item-{{ $p->id }}">
                        <td>
                            @if($p->image_path)
                                <img src="{{ asset($p->image_path) }}" alt="{{ $p->title }}" class="w-10 h-6 object-cover rounded border border-[#1f1f1f]">
                            @else
                                <span class="text-xs text-gray-600 font-mono">None</span>
                            @endif
                        </td>
                        <td class="font-semibold text-white">{{ $p->title }}</td>
                        <td>
                            <div class="flex flex-wrap gap-1">
                                @foreach ($p->technologies ?? [] as $tech)
                                    <span class="badge badge--positive text-[9px]">{{ $tech }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold {{ $p->status->value === 'published' ? 'bg-[#1e2d0a] text-primary-300 border border-primary-500/20' : 'bg-gray-800 text-gray-400' }}">
                                {{ ucfirst($p->status->value) }}
                            </span>
                        </td>
                        <td class="text-right space-x-2">
                            <button wire:click="editProject({{ $p->id }})" class="text-primary-300 hover:text-primary-100 text-xs font-semibold transition-all cursor-pointer">
                                Edit
                            </button>
                            <button wire:click="deleteProject({{ $p->id }})" wire:confirm="Are you sure?" class="text-red-400 hover:text-red-300 text-xs font-semibold transition-all cursor-pointer">
                                Remove
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500">No projects published.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
