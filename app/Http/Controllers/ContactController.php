<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __invoke(Request $request)
    {
        $form = $request->validate([
            'name' => 'nullable|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        logger($form );
        Mail::to('edonyaboebiye11@gmail.com')->send(new ContactMail($form));

        return back()->with('success', 'Message sent successfully!');
    }
}
