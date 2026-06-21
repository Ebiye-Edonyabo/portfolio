<?php

namespace App\Livewire\Admin\Cms;

use App\Enums\Status;
use App\Livewire\Admin\Cms\Forms\ToolForm;
use App\Models\Tool;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class Tools extends Component
{
    use WithFileUploads;

    public ToolForm $form;

    public function editTool(int $id): void
    {
        $tool = Tool::findOrFail($id);
        $this->form->load($tool);
    }

    public function saveTool(): void
    {
        $this->form->save();

        $this->dispatch('notification', message: 'Tool saved successfully!');
        $this->resetFormStates();
    }

    public function deleteTool(int $id): void
    {
        Tool::findOrFail($id)->delete();
        $this->dispatch('notification', message: 'Tool removed successfully!');
    }

    public function resetFormStates(): void
    {
        $this->form->reset();
    }

    #[Layout('components.layouts.admin', ['title' => 'CMS / Tools'])]
    public function render(): View
    {
        return view('livewire.admin.cms.tools', [
            'tools' => Tool::orderBy('order')->get(),
            'statusOptions' => Status::options(),
        ]);
    }
}
