<?php

namespace App\Livewire\Forms;

use App\Enums\AllocationStatus;
use App\Models\Allocation;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AllocationForm extends Form
{
    public ?Allocation $allocation = null;

    #[Validate('required|string|max:255')]
    public string $name = '';

    public ?string $amount = '0.00';

    #[Validate([
        'required',
        'string',
    ])]
    public string $status = 'pending';

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', Rule::enum(AllocationStatus::class)],
        ];
    }

    public function setAllocation(Allocation $allocation): void
    {
        $this->allocation = $allocation;
        $this->name = $allocation->name;
        $this->amount = number_format($allocation->amount, 2, '.', '');
        $this->status = $allocation->status->value;
    }

    public function store(): void
    {
        $this->formatAmount();
        $this->validate();
        $this->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        Allocation::create([
            'name' => $this->name,
            'amount' => $this->amount,
            'status' => $this->status,
        ]);

        $this->reset(['name', 'amount', 'status']);
    }

    public function update(): void
    {
        $this->formatAmount();
        $this->validate();
        $this->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $this->allocation->update([
            'name' => $this->name,
            'amount' => $this->amount,
            'status' => $this->status,
        ]);

        $this->reset(['allocation', 'name', 'amount', 'status']);
    }

    protected function formatAmount()
    {
        if ($this->amount !== null) {
            $this->amount = preg_replace('/[^0-9.]/', '', (string) $this->amount);
        }
    }
}
