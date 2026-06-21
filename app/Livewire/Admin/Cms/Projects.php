<?php

namespace App\Livewire\Admin\Cms;

use App\Enums\Status;
use App\Livewire\Admin\Cms\Forms\ProjectForm;
use App\Models\Project;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class Projects extends Component
{
    use WithFileUploads;

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

    #[Layout('components.layouts.admin', ['title' => 'CMS / Projects'])]
    public function render(): View
    {
        return view('livewire.admin.cms.projects', [
            'projects' => Project::latest()->get(),
            'statusOptions' => Status::options(),
        ]);
    }
}
