<div x-data="{
    isCreating: @entangle('isCreating').live,
    isEditing: @entangle('isEditing').live,
    type: @entangle('form.type'),
    category: @entangle('form.category'),
    expenseCategories: {{ json_encode($expenseCategories) }},
    incomeCategories: {{ json_encode($incomeCategories) }},
    get currentCategories() {
        return this.type === 'expense' ? this.expenseCategories : this.incomeCategories;
    },
    init() {
        this.$watch('type', value => {
            this.category = this.currentCategories[0].value;
        });
    }
}">
    <!-- Stats Row -->
    <div class="dashboard-grid gap-6 mb-8">
        <x-admin.stat-card 
            class="col-span-12 sm:col-span-4" 
            title="Total Income" 
            value="₦{{ number_format($totalIncome, 2) }}" 
            valueColor="text-green-400" 
        />
        <x-admin.stat-card 
            class="col-span-12 sm:col-span-4" 
            title="Total Expense" 
            value="₦{{ number_format($totalExpense, 2) }}" 
            valueColor="text-red-400" 
        />
        <x-admin.stat-card 
            class="col-span-12 sm:col-span-4" 
            title="Balance" 
            value="₦{{ number_format($balance, 2) }}" 
            valueColor="{{ $balance >= 0 ? 'text-primary-300' : 'text-red-500' }}" 
        />
    </div>


    <div id="transaction-form" x-show="isCreating || isEditing" style="display: none;" class="bg-[#0d0d0d] border border-[#1f1f1f] rounded-xl p-5 mb-8">
        <h2 class="text-white font-semibold mb-4" x-text="isEditing ? 'Edit Transaction' : 'Add New Transaction'"></h2>
            <form wire:submit="saveTransaction" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-admin.text-input label="Date" model="form.date" type="date" />

                    <x-admin.dropdown-input label="Type" model="form.type">
                        @foreach ($transactionTypes as $typeCase)
                            <option value="{{ $typeCase->value }}">{{ ucfirst($typeCase->value) }}</option>
                        @endforeach
                    </x-admin.dropdown-input>

                    <x-admin.dropdown-input label="Category" model="form.category">
                        <template x-for="cat in currentCategories" :key="cat.value">
                            <option x-bind:value="cat.value" x-text="cat.label" x-bind:selected="cat.value == category"></option>
                        </template>
                    </x-admin.dropdown-input>

                    <x-admin.text-input label="Description" model="form.description" placeholder="e.g. Light" />
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
                </div>
                
                <div class="flex items-center justify-end gap-3 mt-4">
                    <button type="button" x-on:click="isCreating = false; isEditing = false; $wire.cancelCreate()" class="btn bg-[#171717] hover:bg-[#1f1f1f] text-white">Cancel</button>
                    <button type="submit" class="btn btn--primary" x-text="isEditing ? 'Update Transaction' : 'Save Transaction'"></button>
                </div>
            </form>
        </div>

    <x-admin.table-card title="Transactions History">
        <x-slot:actions>
            <button x-show="!isCreating && !isEditing" 
                x-on:click="isCreating = true; 
                $wire.showCreateForm()" 
                class="btn btn--primary text-xs py-1 px-3 flex items-center gap-2" style="display: none;"
            >
                <i class="fa-solid fa-plus"></i> Add Transaction
            </button>
        </x-slot:actions>

        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Category</th>
                <th>Description</th>
                <th>Amount</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr wire:key="transaction-{{ $transaction->id }}">
                    <td>{{ $transaction->date->format('M d, Y') }}</td>
                    <td> {{ ucwords($transaction->type->value) }}</td>
                    <td>{{ $transaction->category->label() }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td class="font-medium">₦{{ number_format($transaction->amount, 2) }}</td>
                    <td class="text-right">
                        <button wire:click="editTransaction({{ $transaction->id }})" class="text-primary-300 hover:text-primary-400 transition-colors mr-3" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button x-data x-on:click="$dispatch('open-confirmation-modal', {
                            title: 'Delete Transaction',
                            message: 'Are you sure you want to permanently delete this transaction? This action cannot be undone.',
                            action: { method: 'deleteTransaction', params: [{{ $transaction->id }}] }
                        })" class="text-red-400 hover:text-red-300 transition-colors" title="Delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-500">No transactions recorded yet.</td>
                </tr>
            @endforelse
        </tbody>
    </x-admin.table-card>

    <div class="mt-4">
        {{ $transactions->links(data: ['scrollTo' => false]) }}
    </div>

    <!-- Reusable Confirmation Modal -->
    <x-admin.confirmation-modal />
</div>
