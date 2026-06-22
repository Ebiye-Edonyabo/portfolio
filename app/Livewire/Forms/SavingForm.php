<?php

namespace App\Livewire\Forms;

use App\Models\Saving;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SavingForm extends Form
{
    public ?Saving $saving = null;

    #[Validate('required|exists:saving_plans,id')]
    public ?int $saving_plan_id = null;

    #[Validate('required|date')]
    public string $date = '';

    public ?string $amount = '0.00';

    #[Validate('nullable|string')]
    public ?string $notes = null;

    public function setSaving(Saving $saving): void
    {
        $this->saving = $saving;
        $this->saving_plan_id = $saving->saving_plan_id;
        $this->date = $saving->date->format('Y-m-d');
        $this->amount = number_format($saving->amount, 2, '.', '');
        $this->notes = $saving->notes;
    }

    public function store(): void
    {
        $this->formatAmount();
        $this->validate();
        $this->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        Saving::create([
            'saving_plan_id' => $this->saving_plan_id,
            'date' => $this->date,
            'amount' => $this->amount,
            'notes' => $this->notes,
        ]);

        $this->reset(['amount', 'notes']);
    }

    public function update(): void
    {
        $this->formatAmount();
        $this->validate();
        $this->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $this->saving->update([
            'saving_plan_id' => $this->saving_plan_id,
            'date' => $this->date,
            'amount' => $this->amount,
            'notes' => $this->notes,
        ]);

        $this->reset(['saving', 'amount', 'notes']);
    }

    protected function formatAmount()
    {
        if ($this->amount !== null) {
            $this->amount = preg_replace('/[^0-9.]/', '', (string) $this->amount);
        }
    }
}
