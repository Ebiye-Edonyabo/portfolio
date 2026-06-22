<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\SavingForm;
use App\Models\Saving;
use App\Models\SavingPlan;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Savings extends Component
{
    use WithPagination;

    public SavingForm $form;

    public bool $isCreating = false;

    public bool $isEditing = false;

    public function mount(): void
    {
        $this->form->date = now()->format('Y-m-d');
    }

    public function showCreateForm(): void
    {
        $this->form->reset(['saving', 'saving_plan_id', 'amount', 'notes']);
        $this->form->date = now()->format('Y-m-d');
        $this->isCreating = true;
        $this->isEditing = false;

        $this->js("document.getElementById('saving-form').scrollIntoView({ behavior: 'smooth', block: 'start' })");
    }

    public function editSaving(int $id): void
    {
        $saving = Saving::findOrFail($id);
        $this->form->setSaving($saving);

        $this->isEditing = true;
        $this->isCreating = false;

        $this->js("document.getElementById('saving-form').scrollIntoView({ behavior: 'smooth', block: 'start' })");
    }

    public function cancelCreate(): void
    {
        $this->isCreating = false;
        $this->isEditing = false;
        $this->form->reset(['saving', 'saving_plan_id', 'amount', 'notes']);
        $this->form->resetValidation();
    }

    public function saveSaving(): void
    {
        if ($this->isEditing) {
            $this->form->update();
            $this->isEditing = false;
            $this->dispatch('notification', message: 'Saving record updated successfully.');
        } else {
            $this->form->store();
            $this->isCreating = false;
            $this->dispatch('notification', message: 'Saving record added successfully.');
        }
    }

    public function deleteSaving(int $id): void
    {
        Saving::findOrFail($id)->delete();
        $this->dispatch('notification', message: 'Saving record deleted successfully.');
    }

    #[Layout('components.layouts.admin', ['title' => 'Savings'])]
    public function render(): View
    {
        $savings = Saving::with('savingPlan')->latest('date')->latest('id')->paginate(10);
        $savingPlans = SavingPlan::orderBy('name')->get();

        return view('livewire.admin.savings', [
            'savings' => $savings,
            'savingPlans' => $savingPlans,
        ]);
    }
}
