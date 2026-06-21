<?php

namespace App\Livewire\Admin\Cms;

use App\Enums\Status;
use App\Livewire\Admin\Cms\Forms\ExperienceForm;
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

    #[Layout('components.layouts.admin', ['title' => 'CMS / Experience'])]
    public function render(): View
    {
        return view('livewire.admin.cms.experiences', [
            'experiences' => Experience::latest()->get(),
            'statusOptions' => Status::options(),
        ]);
    }
}
