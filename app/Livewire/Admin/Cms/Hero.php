<?php

namespace App\Livewire\Admin\Cms;

use App\Livewire\Admin\Cms\Forms\HeroForm;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class Hero extends Component
{
    use WithFileUploads;

    public HeroForm $form;

    public function mount(): void
    {
        $this->form->load();
    }

    public function saveHero(): void
    {
        $this->form->save();

        $this->dispatch('notification', message: 'Hero settings updated successfully!');
    }

    #[Layout('components.layouts.admin', ['title' => 'CMS / Hero'])]
    public function render(): View
    {
        return view('livewire.admin.cms.hero');
    }
}
