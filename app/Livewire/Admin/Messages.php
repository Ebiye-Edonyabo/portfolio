<?php

namespace App\Livewire\Admin;

use App\Models\Message;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Messages extends Component
{
    public function deleteMessage(int $id): void
    {
        Message::findOrFail($id)->delete();
        $this->dispatch('notification', message: 'Message deleted successfully!');
    }

    #[Layout('components.layouts.admin', ['title' => 'Message Logs'])]
    public function render(): View
    {
        return view('livewire.admin.messages', [
            'allMessages' => Message::latest()->get(),
        ]);
    }
}
