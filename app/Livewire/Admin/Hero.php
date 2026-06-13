<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\Forms\HeroForm;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Hero extends Component
{
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

    #[Layout('components.layouts.admin', ['title' => 'CMS / Hero Editor'])]
    public function render(): View
    {
        return view('livewire.admin.hero');
    }
}
