<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\Forms\ExperienceForm;
use App\Models\Experience;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Experiences extends Component
{
    public ExperienceForm $form;

    public function editExperience(int $id): void
    {
        $exp = Experience::findOrFail($id);
        $this->form->load($exp);
    }

    public function saveExperience(): void
    {
        $this->form->save();

        $this->dispatch('notification', message: 'Experience saved successfully!');
        $this->resetFormStates();
    }

    public function deleteExperience(int $id): void
    {
        Experience::findOrFail($id)->delete();
        $this->dispatch('notification', message: 'Experience record removed successfully!');
    }

    public function resetFormStates(): void
    {
        $this->form->reset();
    }

    public function addProject(): void
    {
        $this->form->addProject();
    }

    public function removeProject(int $index): void
    {
        $this->form->removeProject($index);
    }

    #[Layout('components.layouts.admin', ['title' => 'CMS / Experience Timeline'])]
    public function render(): View
    {
        return view('livewire.admin.experiences', [
            'experiences' => Experience::latest()->get(),
        ]);
    }
}
