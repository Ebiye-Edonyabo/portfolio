<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    #[Validate('nullable|string')] 
    public $name;

    #[Validate('required|email')] 
    public $email;

    #[Validate('required|string')] 
    public $message;

    public function save()
    {
        $form = $this->validate(); 
 
        Mail::to('edonyaboebiye11@gmail.com')->send(new ContactMail($form));
        
        $this->dispatch(event: 'notification', message: 'Message sent successfully!');

        $this->reset();
        
        return back();
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
