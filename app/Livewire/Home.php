<?php

namespace App\Livewire;

use App\Models\Experience;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Tool;
use Illuminate\View\View;
use Livewire\Component;

class Home extends Component
{
    public function render(): View
    {
        return view('livewire.home', [
            'settings' => Setting::where('page', 'home')->pluck('value', 'key'),
            'tools' => Tool::orderBy('order')->get(),
            'projects' => Project::all(),
            'experiences' => Experience::all(),
        ]);
    }
}
