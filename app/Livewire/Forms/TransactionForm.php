<?php

namespace App\Livewire\Forms;

use App\Models\Transaction;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TransactionForm extends Form
{
    public ?Transaction $transaction = null;

    #[Validate('required|date')]
    public string $date = '';

    #[Validate('required|string')]
    public string $type = '';

    #[Validate('required|string')]
    public string $category = '';

    #[Validate('required|string|max:255')]
    public string $description = '';

    public ?string $amount = '0.00';

    public function setTransaction(Transaction $transaction): void
    {
        $this->transaction = $transaction;
        $this->date = $transaction->date->format('Y-m-d');
        $this->type = $transaction->type->value;
        $this->category = $transaction->category->value;
        $this->description = $transaction->description;
        $this->amount = number_format($transaction->amount, 2, '.', '');
    }

    public function store(): void
    {
        $this->formatAmount();

        $this->validate();

        $this->validate([
            'amount' => 'required|numeric|min:0.01',
        ], [
            'amount.min' => 'The amount must be at least ₦0.01.',
        ]);

        Transaction::create([
            'date' => $this->date,
            'type' => $this->type,
            'category' => $this->category,
            'description' => $this->description,
            'amount' => $this->amount,
        ]);

        $this->reset(['description', 'amount']);
    }

    public function update(): void
    {
        $this->formatAmount();

        $this->validate();

        $this->validate([
            'amount' => 'required|numeric|min:0.01',
        ], [
            'amount.min' => 'The amount must be at least ₦0.01.',
        ]);

        $this->transaction->update([
            'date' => $this->date,
            'type' => $this->type,
            'category' => $this->category,
            'description' => $this->description,
            'amount' => $this->amount,
        ]);

        $this->reset(['description', 'amount', 'transaction']);
    }

    protected function formatAmount()
    {
        if ($this->amount !== null) {
            $this->amount = preg_replace('/[^0-9.]/', '', (string) $this->amount);
        }
    }
}
