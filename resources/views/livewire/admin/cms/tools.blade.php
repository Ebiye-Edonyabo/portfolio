<div class="dashboard-grid gap-6">
    <!-- Left Column: Tool CRUD Form -->
    <div class="col-span-12 lg:col-span-4 bg-[#121212] border border-[#1f1f1f] rounded-xl p-6 h-fit">
        <h4 class="text-xs font-semibold uppercase tracking-wider text-white mb-4 border-b border-[#1f1f1f] pb-2">
            {{ $form->id ? 'Edit Tool Specs' : 'Register New Tool' }}
        </h4>
        <form wire:submit="saveTool" class="space-y-4">
            <!-- Name -->
            <x-admin.text-input label="Tool Name" model="form.name" required />

            <!-- Logo Path & Upload -->
            <div class="space-y-2">
                <x-admin.text-input label="Logo SVG Path (Manual)" model="form.logo_path" placeholder="icons/Laravel.svg" />
                
                <div class="space-y-1">
                    <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider block">Or Upload SVG/Image File</label>
                    <input type="file" wire:model="form.logo_file" accept=".svg,.png,.jpg,.jpeg,.webp"
                        class="w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-1.5 rounded-lg text-xs outline-none focus:border-primary-300 file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[11px] file:font-semibold file:bg-[#1e2d0a] file:text-primary-300 hover:file:bg-[#1e2d0a]/80 transition-all cursor-pointer">
                    @error('form.logo_file') <span class="text-red-400 text-xs block mt-1">{{ $message }}</span> @enderror
                </div>

                @if ($form->logo_file)
                    <div class="mt-2 p-2 bg-[#171717] rounded-lg border border-[#1f1f1f] w-fit">
                        <span class="text-[10px] text-gray-400 block mb-1">Temporary Upload:</span>
                        <span class="text-xs text-white font-mono font-semibold">{{ $form->logo_file->getClientOriginalName() }}</span>
                    </div>
                @elseif ($form->logo_path)
                    <div class="mt-2 p-2 bg-[#171717] rounded-lg border border-[#1f1f1f] w-fit">
                        <span class="text-[10px] text-gray-400 block mb-1">Current Logo:</span>
                        <img src="{{ asset($form->logo_path) }}" class="h-8 object-contain">
                    </div>
                @endif
            </div>

            <!-- Order -->
            <x-admin.text-input label="Display Order" model="form.order" type="number" required />

            <!-- Status -->
            <x-admin.dropdown-input label="Status" model="form.status" required>
                @foreach ($statusOptions as $option)
                    <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                @endforeach
            </x-admin.dropdown-input>

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
    <x-admin.table-card title="Active Tools Grid" class="col-span-12 lg:col-span-8">
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
                        <x-admin.status-badge :status="$t->status" />
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
    </x-admin.table-card>
</div>
