<div x-data="{
    isCreating: @entangle('isCreating').live,
    isEditing: @entangle('isEditing').live
}">
    <div id="saving-form" x-show="isCreating || isEditing" style="display: none;" class="bg-[#0d0d0d] border border-[#1f1f1f] rounded-xl p-5 mb-8">
        <h2 class="text-white font-semibold mb-4" x-text="isEditing ? 'Edit Saving Record' : 'Add New Saving'"></h2>
        <form wire:submit="saveSaving" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-admin.dropdown-input label="Saving Plan" model="form.saving_plan_id">
                    <option value="">Select a Plan</option>
                    @foreach($savingPlans as $plan)
                        <option value="{{ $plan->id }}">{{ $plan->name }} ({{ $plan->platform_name }})</option>
                    @endforeach
                </x-admin.dropdown-input>

                <x-admin.text-input label="Date" model="form.date" type="date" />
                
                <x-admin.text-input 
                    label="Amount (₦)" 
                    model="form.amount" 
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
                
                <x-admin.text-input label="Notes" model="form.notes" placeholder="Optional notes" />
            </div>
            
            <div class="flex items-center justify-end gap-3 mt-4">
                <button type="button" x-on:click="isCreating = false; isEditing = false; $wire.cancelCreate()" class="btn bg-[#171717] hover:bg-[#1f1f1f] text-white">Cancel</button>
                <button type="submit" class="btn btn--primary" x-text="isEditing ? 'Update' : 'Save'"></button>
            </div>
        </form>
    </div>

    <x-admin.table-card title="Savings">
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
                <th>Date</th>
                <th>Plan Name</th>
                <th>Amount</th>
                <th>Notes</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($savings as $saving)
                <tr wire:key="saving-{{ $saving->id }}">
                    <td class="text-nowrap">{{ $saving->date->format('M d, Y') }}</td>
                    <td class="font-medium text-white">{{ $saving->savingPlan->name ?? 'N/A' }}</td>
                    <td class="font-medium text-primary-300">₦{{ number_format($saving->amount, 2) }}</td>
                    <td>
                        <div class="min-w-65 text-sm text-gray-400">
                            {{ $saving->notes ?? '-' }}
                        </div>
                    </td>
                    <td class="text-right">
                        <button wire:click="editSaving({{ $saving->id }})" class="text-primary-300 hover:text-primary-400 transition-colors mr-3" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button x-data x-on:click="$dispatch('open-confirmation-modal', {
                            title: 'Delete Saving Record',
                            message: 'Are you sure you want to permanently delete this record?',
                            action: { method: 'deleteSaving', params: [{{ $saving->id }}] }
                        })" class="text-red-400 hover:text-red-300 transition-colors" title="Delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-8 text-gray-500">No savings recorded yet.</td>
                </tr>
            @endforelse
        </tbody>
    </x-admin.table-card>

    <div class="mt-4">
        {{ $savings->links(data: ['scrollTo' => false]) }}
    </div>

    <!-- Reusable Confirmation Modal -->
    <x-admin.confirmation-modal />
</div>
