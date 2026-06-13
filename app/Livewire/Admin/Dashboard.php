<?php

namespace App\Livewire\Admin;

use App\Models\Experience;
use App\Models\Message;
use App\Models\Project;
use App\Models\Tool;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('components.layouts.admin', ['title' => 'Dashboard Overview'])]
    public function render(): View
    {
        return view('livewire.admin.dashboard', [
            'messagesCount' => Message::count(),
            'projectsCount' => Project::count(),
            'toolsCount' => Tool::count(),
            'experiencesCount' => Experience::count(),
            'latestMessages' => Message::latest()->take(5)->get(),
        ]);
    }
}
