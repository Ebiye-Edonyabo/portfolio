<?php

namespace App\Livewire\Admin;

use App\Enums\TransactionCategory;
use App\Enums\TransactionType;
use App\Livewire\Forms\TransactionForm;
use App\Models\Transaction;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Transactions extends Component
{
    use WithPagination;

    public TransactionForm $form;

    public bool $isCreating = false;

    public bool $isEditing = false;

    public function mount(): void
    {
        $this->form->date = now()->format('Y-m-d');
        $this->form->type = TransactionType::Expense->value;
        $this->form->category = TransactionCategory::Food->value;
    }

    public function showCreateForm(): void
    {
        $this->form->reset(['description', 'amount', 'transaction']);
        $this->form->date = now()->format('Y-m-d');
        $this->form->type = TransactionType::Expense->value;
        $this->form->category = TransactionCategory::Food->value;
        $this->isCreating = true;
        $this->isEditing = false;

        $this->js("document.getElementById('transaction-form').scrollIntoView({ behavior: 'smooth', block: 'start' })");
    }

    public function editTransaction(int $id): void
    {
        $transaction = Transaction::findOrFail($id);
        $this->form->setTransaction($transaction);

        $this->isEditing = true;
        $this->isCreating = false;

        $this->js("document.getElementById('transaction-form').scrollIntoView({ behavior: 'smooth', block: 'start' })");
    }

    public function cancelCreate(): void
    {
        $this->isCreating = false;
        $this->isEditing = false;
        $this->form->reset(['description', 'amount', 'transaction']);
        $this->form->resetValidation();
    }

    public function saveTransaction(): void
    {
        if ($this->isEditing) {
            $this->form->update();
            $this->isEditing = false;
            $this->dispatch('notification', message: 'Transaction updated successfully.');
        } else {
            $this->form->store();
            $this->isCreating = false;
            $this->dispatch('notification', message: 'Transaction added successfully.');
        }
    }

    public function deleteTransaction(int $id): void
    {
        Transaction::findOrFail($id)->delete();
        $this->dispatch('notification', message: 'Transaction deleted successfully.');
    }

    #[Layout('components.layouts.admin', ['title' => 'Transactions'])]
    public function render(): View
    {
        $transactions = Transaction::latest('date')->latest('id')->paginate(10);

        // Calculate Totals
        $totalIncome = Transaction::where('type', TransactionType::Income)->sum('amount');
        $totalExpense = Transaction::where('type', TransactionType::Expense)->sum('amount');
        // $balance = $totalIncome - $totalExpense;

        return view('livewire.admin.transactions', [
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            // 'balance' => $balance,
            'transactionTypes' => TransactionType::cases(),
            'expenseCategories' => array_map(fn ($c) => ['value' => $c->value, 'label' => $c->label()], TransactionCategory::expenses()),
            'incomeCategories' => array_map(fn ($c) => ['value' => $c->value, 'label' => $c->label()], TransactionCategory::incomes()),
        ]);
    }
}
