<?php

namespace App\Livewire;

use App\Enums\Status;
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
            'tools' => Tool::where('status', Status::Published)->orderBy('order')->get(),
            'projects' => Project::where('status', Status::Published)->get(),
            'experiences' => Experience::where('status', Status::Published)->get(),
        ]);
    }
}
