<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\Forms\ProjectForm;
use App\Models\Project;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Projects extends Component
{
    public ProjectForm $form;

    public function editProject(int $id): void
    {
        $project = Project::findOrFail($id);
        $this->form->load($project);
    }

    public function saveProject(): void
    {
        $this->form->save();

        $this->dispatch('notification', message: 'Project saved successfully!');
        $this->resetFormStates();
    }

    public function deleteProject(int $id): void
    {
        Project::findOrFail($id)->delete();
        $this->dispatch('notification', message: 'Project removed successfully!');
    }

    public function resetFormStates(): void
    {
        $this->form->reset();
    }

    #[Layout('components.layouts.admin', ['title' => 'CMS / Projects CRUD'])]
    public function render(): View
    {
        return view('livewire.admin.projects', [
            'projects' => Project::latest()->get(),
        ]);
    }
}
