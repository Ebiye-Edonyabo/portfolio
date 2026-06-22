<div x-data="{
    isCreating: @entangle('isCreating').live,
    isEditing: @entangle('isEditing').live
}">
    <!-- Stats Row -->
    <div class="dashboard-grid gap-6 mb-8">
        @foreach($savingPlans as $plan)
            <x-admin.stat-card 
                class="col-span-12 sm:col-span-6 lg:col-span-4" 
                title="{{ $plan->name }}" 
                value="₦{{ number_format($plan->savings_sum_amount ?? 0, 2) }}" 
                valueColor="text-primary-300" 
            />
        @endforeach
    </div>

    <div id="saving-plan-form" x-show="isCreating || isEditing" style="display: none;" class="bg-[#0d0d0d] border border-[#1f1f1f] rounded-xl p-5 mb-8">
        <h2 class="text-white font-semibold mb-4" x-text="isEditing ? 'Edit Saving Plan' : 'Add New Saving Plan'"></h2>
        <form wire:submit="saveSavingPlan" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-admin.text-input label="Name" model="form.name" placeholder="e.g. Vacation Fund" />
                <x-admin.dropdown-input label="Platform Name" model="form.platform_name">
                    @foreach($savingsPlatforms as $platform)
                        <option value="{{ $platform['value'] }}">{{ $platform['label'] }}</option>
                    @endforeach
                </x-admin.dropdown-input>
                
                <x-admin.text-input 
                    label="Target (₦)" 
                    model="form.target" 
                    type="text"
                    x-data="{
                        format() {
                            let val = $el.value.replace(/,/g, '');
                            if (val && !isNaN(val)) {
                                $el.value = parseFloat(val).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                            }
                        }
                    }"
                    x-init="format()"
                    x-on:blur="format()"
                />
                <x-admin.text-input label="Purpose" model="form.purpose" placeholder="e.g. Trip to Dubai" />
                
                <x-admin.text-input label="Duration" model="form.duration" placeholder="e.g. 3 Months" />
                <x-admin.text-input label="Time Line" model="form.time_line" placeholder="e.g. 01 March - 31 May" />
                
                <div class="flex items-center gap-2">
                    <input type="checkbox" wire:model="form.is_locked" id="is_locked" class="rounded bg-[#171717] border-[#1f1f1f] text-primary-500 focus:ring-primary-500">
                    <label for="is_locked" class="text-sm text-gray-300">Is Locked?</label>
                </div>
            </div>
            
            <div class="flex items-center justify-end gap-3 mt-4">
                <button type="button" x-on:click="isCreating = false; isEditing = false; $wire.cancelCreate()" class="btn bg-[#171717] hover:bg-[#1f1f1f] text-white">Cancel</button>
                <button type="submit" class="btn btn--primary" x-text="isEditing ? 'Update' : 'Save'"></button>
            </div>
        </form>
    </div>

    <x-admin.table-card title="Saving Plans">
        <x-slot:actions>
            <button x-show="!isCreating && !isEditing" 
                x-on:click="isCreating = true; $wire.showCreateForm()" 
                class="btn btn--primary text-xs py-1 px-3 flex items-center gap-2" style="display: none;"
            >
                Add
            </button>
        </x-slot:actions>

        <thead>
            <tr>
                <th>Name</th>
                <th>Platform</th>
                <th>Target</th>
                <th>Status</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($savingPlans as $plan)
                <tr wire:key="plan-{{ $plan->id }}">
                    <td class="font-medium text-white">{{ $plan->name }}</td>
                    <td>{{ $plan->platform_name->label() }}</td>
                    <td class="font-medium text-gray-300">₦{{ number_format($plan->target, 2) }}</td>
                    <td>
                        @if($plan->is_locked)
                            <span class="inline-flex items-center rounded-md bg-red-400/10 px-2 py-1 text-xs font-medium text-red-400 ring-1 ring-inset ring-red-400/20">Locked</span>
                        @else
                            <span class="inline-flex items-center rounded-md bg-green-400/10 px-2 py-1 text-xs font-medium text-green-400 ring-1 ring-inset ring-green-400/20">Flexible</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <button wire:click="editSavingPlan({{ $plan->id }})" class="text-primary-300 hover:text-primary-400 transition-colors" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-500">No saving plans recorded yet.</td>
                </tr>
            @endforelse
        </tbody>
    </x-admin.table-card>

    <div class="mt-4">
        {{ $savingPlans->links(data: ['scrollTo' => false]) }}
    </div>

    <!-- Reusable Confirmation Modal -->
    <x-admin.confirmation-modal />
</div>
