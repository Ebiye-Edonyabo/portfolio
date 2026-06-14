<div class="dashboard-grid gap-6">
    <!-- Left Column: Tool CRUD Form -->
    <div class="col-span-4 bg-[#121212] border border-[#1f1f1f] rounded-xl p-6 h-fit">
        <h4 class="text-xs font-semibold uppercase tracking-wider text-white mb-4 border-b border-[#1f1f1f] pb-2">
            {{ $form->id ? 'Edit Tool Specs' : 'Register New Tool' }}
        </h4>
        <form wire:submit="saveTool" class="space-y-4">
            <!-- Name -->
            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Tool Name</label>
                <input type="text" wire:model="form.name" required
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all">
                @error('form.name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Logo Path -->
            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Logo SVG Path</label>
                <input type="text" wire:model="form.logo_path" required
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all"
                    placeholder="icons/Laravel.svg">
                @error('form.logo_path') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Order -->
            <div class="space-y-1">
                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Display Order</label>
                <input type="number" wire:model="form.order" required
                    class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all">
                @error('form.order') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
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

            <!-- Form Actions -->
            <div class="flex justify-end gap-2 pt-2">
                @if ($form->id)
                    <button type="button" wire:click="resetFormStates" class="btn btn--secondary py-1.5 px-4 text-xs cursor-pointer">
                        Cancel
                    </button>
                @endif
                <button type="submit" class="btn btn--primary py-1.5 px-4 text-xs cursor-pointer">
                    {{ $form->id ? 'Save Changes' : 'Add Tool' }}
                </button>
            </div>
        </form>
    </div>

    <!-- Right Column: Tools Table -->
    <div class="col-span-8 table-container">
        <div class="px-6 py-4 border-b border-[#1f1f1f]">
            <h3 class="text-xs font-bold text-white tracking-wide uppercase">Active Tools Grid</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Path</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tools as $t)
                    <tr wire:key="tool-item-{{ $t->id }}">
                        <td>
                            <img src="{{ asset($t->logo_path) }}" alt="{{ $t->name }}" class="w-5 h-5 object-contain">
                        </td>
                        <td class="font-semibold text-white">{{ $t->name }}</td>
                        <td class="text-gray-500 font-mono text-xs">{{ $t->logo_path }}</td>
                        <td>{{ $t->order }}</td>
                        <td>
                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold {{ $t->status->value === 'published' ? 'bg-[#1e2d0a] text-primary-300 border border-primary-500/20' : 'bg-gray-800 text-gray-400' }}">
                                {{ ucfirst($t->status->value) }}
                            </span>
                        </td>
                        <td class="text-right space-x-2">
                            <button wire:click="editTool({{ $t->id }})" class="text-primary-300 hover:text-primary-100 text-xs font-semibold transition-all cursor-pointer">
                                Edit
                            </button>
                            <button wire:click="deleteTool({{ $t->id }})" wire:confirm="Are you sure?" class="text-red-400 hover:text-red-300 text-xs font-semibold transition-all cursor-pointer">
                                Remove
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-500">No tools cataloged yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
