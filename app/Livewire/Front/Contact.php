<?php

namespace App\Livewire\Front;

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
        $this->validate();

        // هنا يمكنك إضافة منطق إرسال البريد الإلكتروني
        // Mail::to('support@amarafood.com')->send(new ContactMail($this->name, $this->email, $this->subject, $this->message));

        session()->flash('message', 'شكراً لك! تم إرسال رسالتك بنجاح وسنقوم بالرد عليك قريباً.');
        
        $this->reset(['name', 'email', 'phone', 'subject', 'message']);
    }

    public function render()
    {
        $email = \App\Models\Setting::getValue('email', 'support@amarafood.com');
        $phone = \App\Models\Setting::getValue('phone', '+963 99 999 9999');
        $facebook = \App\Models\Setting::getValue('facebook', '');
        $twitter = \App\Models\Setting::getValue('twitter', '');
        $instagram = \App\Models\Setting::getValue('instagram', '');
        $whatsapp = \App\Models\Setting::getValue('whatsapp', '');

        return view('livewire.front.contact', compact('email', 'phone', 'facebook', 'twitter', 'instagram', 'whatsapp'));
    }
}

