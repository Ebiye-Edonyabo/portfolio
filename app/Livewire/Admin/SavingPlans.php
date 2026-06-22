<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\SavingPlanForm;
use App\Models\SavingPlan;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class SavingPlans extends Component
{
    use WithPagination;

    public SavingPlanForm $form;

    public bool $isCreating = false;

    public bool $isEditing = false;

    public function mount(): void
    {
        //
    }

    public function showCreateForm(): void
    {
        $this->form->reset(['savingPlan', 'name', 'platform_name', 'target', 'purpose', 'is_locked', 'duration', 'time_line']);
        $this->form->is_locked = false;
        $this->isCreating = true;
        $this->isEditing = false;

        $this->js("document.getElementById('saving-plan-form').scrollIntoView({ behavior: 'smooth', block: 'start' })");
    }

    public function editSavingPlan(int $id): void
    {
        $savingPlan = SavingPlan::findOrFail($id);
        $this->form->setSavingPlan($savingPlan);

        $this->isEditing = true;
        $this->isCreating = false;

        $this->js("document.getElementById('saving-plan-form').scrollIntoView({ behavior: 'smooth', block: 'start' })");
    }

    public function cancelCreate(): void
    {
        $this->isCreating = false;
        $this->isEditing = false;
        $this->form->reset(['savingPlan', 'name', 'platform_name', 'target', 'purpose', 'is_locked', 'duration', 'time_line']);
        $this->form->resetValidation();
    }

    public function saveSavingPlan(): void
    {
        if ($this->isEditing) {
            $this->form->update();
            $this->isEditing = false;
            $this->dispatch('notification', message: 'Saving Plan updated successfully.');
        } else {
            $this->form->store();
            $this->isCreating = false;
            $this->dispatch('notification', message: 'Saving Plan added successfully.');
        }
    }

    public function deleteSavingPlan(int $id): void
    {
        SavingPlan::findOrFail($id)->delete();
        $this->dispatch('notification', message: 'Saving Plan deleted successfully.');
    }

    #[Layout('components.layouts.admin', ['title' => 'Saving Plans'])]
    public function render(): View
    {
        $savingPlans = SavingPlan::withSum('savings', 'amount')->latest('id')->paginate(10);

        return view('livewire.admin.saving-plans', [
            'savingPlans' => $savingPlans,
            'savingsPlatforms' => \App\Enums\SavingsPlatform::options(),
        ]);
    }
}
