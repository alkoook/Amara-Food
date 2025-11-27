<?php

namespace App\Livewire\Front;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{
    protected $layout = 'components.layouts.app';

    public $name = '';
    public $email = '';
    public $phone = '';
    public $subject = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string|max:2000',
    ];

public function submit()
{

    $this->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required|string',
        'message' => 'required|string',
    ]);

    // إرسال الإيميل
    Mail::to('support@amarafood.com')->send(new ContactMail(
        $this->name,
        $this->email,
        $this->subject,
        $this->message
    ));

    session()->flash('message', 'شكراً لك! تم إرسال رسالتك بنجاح.');

    $this->reset(['name', 'email', 'phone', 'subject', 'message']);
}


    public function render()
    {
        $connectedEmail = \App\Models\Setting::getValue('email');
        $connectedPhone = \App\Models\Setting::getValue('phone');
        $facebook = \App\Models\Setting::getValue('facebook', '');
        $twitter = \App\Models\Setting::getValue('twitter', '');
        $instagram = \App\Models\Setting::getValue('instagram', '');
        $whatsapp = \App\Models\Setting::getValue('whatsapp', '');

        return view('livewire.front.contact', compact('connectedEmail', 'connectedPhone', 'facebook', 'twitter', 'instagram', 'whatsapp'))->layout('components.front-layout');
    }
}