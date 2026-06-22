<div x-data="{
    isCreating: @entangle('isCreating').live,
    isEditing: @entangle('isEditing').live
}">
    <!-- Stats Row -->
    <div class="dashboard-grid gap-6 mb-8">
        <x-admin.stat-card 
            class="col-span-12 sm:col-span-6" 
            title="Total Pending" 
            value="₦{{ number_format($totalPending, 2) }}" 
            valueColor="text-yellow-500" 
        />
        <x-admin.stat-card 
            class="col-span-12 sm:col-span-6" 
            title="Total Funded" 
            value="₦{{ number_format($totalFunded, 2) }}" 
            valueColor="text-green-400" 
        />
    </div>
    <div id="allocation-form" x-show="isCreating || isEditing" style="display: none;" class="bg-[#0d0d0d] border border-[#1f1f1f] rounded-xl p-5 mb-8">
        <h2 class="text-white font-semibold mb-4" x-text="isEditing ? 'Edit Allocation' : 'Add New Allocation'"></h2>
        <form wire:submit="saveAllocation" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-admin.text-input label="Name" model="form.name" placeholder="e.g. Yearly Rent" />
                
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
                
                <x-admin.dropdown-input label="Status" model="form.status">
                    @foreach($allocationStatuses as $statusOption)
                        <option value="{{ $statusOption['value'] }}">{{ $statusOption['label'] }}</option>
                    @endforeach
                </x-admin.dropdown-input>
            </div>
            
            <div class="flex items-center justify-end gap-3 mt-4">
                <button type="button" x-on:click="isCreating = false; isEditing = false; $wire.cancelCreate()" class="btn bg-[#171717] hover:bg-[#1f1f1f] text-white">Cancel</button>
                <button type="submit" class="btn btn--primary" x-text="isEditing ? 'Update' : 'Save'"></button>
            </div>
        </form>
    </div>

    <x-admin.table-card title="Allocations">
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
                <th>Amount</th>
                <th>Status</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($allocations as $allocation)
                <tr wire:key="allocation-{{ $allocation->id }}">
                    <td class="font-medium text-white">{{ $allocation->name }}</td>
                    <td class="font-medium text-primary-300">₦{{ number_format($allocation->amount, 2) }}</td>
                    <td>
                        @if($allocation->status === \App\Enums\AllocationStatus::Funded)
                            <span class="inline-flex items-center rounded-md bg-green-400/10 px-2 py-1 text-xs font-medium text-green-400 ring-1 ring-inset ring-green-400/20">Funded</span>
                        @else
                            <span class="inline-flex items-center rounded-md bg-yellow-400/10 px-2 py-1 text-xs font-medium text-yellow-500 ring-1 ring-inset ring-yellow-400/20">Pending</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <button wire:click="editAllocation({{ $allocation->id }})" class="text-primary-300 hover:text-primary-400 transition-colors mr-3" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button x-data x-on:click="$dispatch('open-confirmation-modal', {
                            title: 'Delete Allocation',
                            message: 'Are you sure you want to permanently delete this allocation?',
                            action: { method: 'deleteAllocation', params: [{{ $allocation->id }}] }
                        })" class="text-red-400 hover:text-red-300 transition-colors" title="Delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-8 text-gray-500">No allocations recorded yet.</td>
                </tr>
            @endforelse
        </tbody>
    </x-admin.table-card>

    <div class="mt-4">
        {{ $allocations->links(data: ['scrollTo' => false]) }}
    </div>

    <!-- Reusable Confirmation Modal -->
    <x-admin.confirmation-modal />
</div>
