<?php

namespace App\Livewire\Admin;

use App\Enums\AllocationStatus;
use App\Livewire\Forms\AllocationForm;
use App\Models\Allocation;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Allocations extends Component
{
    use WithPagination;

    public AllocationForm $form;

    public bool $isCreating = false;

    public bool $isEditing = false;

    public function mount(): void
    {
        //
    }

    public function showCreateForm(): void
    {
        $this->form->reset(['allocation', 'name', 'amount']);
        $this->form->status = 'pending';
        $this->isCreating = true;
        $this->isEditing = false;

        $this->js("document.getElementById('allocation-form').scrollIntoView({ behavior: 'smooth', block: 'start' })");
    }

    public function editAllocation(int $id): void
    {
        $allocation = Allocation::findOrFail($id);
        $this->form->setAllocation($allocation);

        $this->isEditing = true;
        $this->isCreating = false;

        $this->js("document.getElementById('allocation-form').scrollIntoView({ behavior: 'smooth', block: 'start' })");
    }

    public function cancelCreate(): void
    {
        $this->isCreating = false;
        $this->isEditing = false;
        $this->form->reset(['allocation', 'name', 'amount']);
        $this->form->resetValidation();
    }

    public function saveAllocation(): void
    {
        if ($this->isEditing) {
            $this->form->update();
            $this->isEditing = false;
            $this->dispatch('notification', message: 'Allocation updated successfully.');
        } else {
            $this->form->store();
            $this->isCreating = false;
            $this->dispatch('notification', message: 'Allocation added successfully.');
        }
    }

    public function deleteAllocation(int $id): void
    {
        Allocation::findOrFail($id)->delete();
        $this->dispatch('notification', message: 'Allocation deleted successfully.');
    }

    #[Layout('components.layouts.admin', ['title' => 'Allocations'])]
    public function render(): View
    {
        $allocations = Allocation::latest('id')->paginate(10);
        
        $totalPending = Allocation::where('status', AllocationStatus::Pending)->sum('amount');
        $totalFunded = Allocation::where('status', AllocationStatus::Funded)->sum('amount');

        return view('livewire.admin.allocations', [
            'allocations' => $allocations,
            'totalPending' => $totalPending,
            'totalFunded' => $totalFunded,
            'allocationStatuses' => AllocationStatus::options(),
        ]);
    }
}
