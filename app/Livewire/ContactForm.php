<?php

namespace App\Livewire;

use App\Mail\ContactMail;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactForm extends Component
{
    #[Validate('nullable|string')]
    public $name;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|string')]
    public $message;

    public function save(): mixed
    {
        $form = $this->validate();

        Message::create([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        Mail::to('edonyaboebiye11@gmail.com')->send(new ContactMail($form));

        $this->dispatch(event: 'notification', message: 'Message sent successfully!');

        $this->reset();

        return back();
    }

    public function render(): View
    {
        return view('livewire.contact-form');
    }
}
