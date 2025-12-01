<?php

namespace App\Livewire\Front;

use App\Mail\ContactMail;
use App\Models\Setting;
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
//  public function getEmbedLink($url)
// {
//     $parsed = parse_url($url);

//     if ($parsed && isset($parsed['host']) && str_contains($parsed['host'], 'google.com')) {
//         return str_replace('/place/', '/maps/embed?pb=', $url);
//     }

//     return $url; // لو رابط آخر، خلي كما هو
// }

public function submit()
{

    $this->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required|string',
        'message' => 'required|string',
    ]);

    // إرسال الإيميل
    Mail::to('ahmadkoke21@gmail.com')->send(new ContactMail(
        $this->name,
        $this->email,
        $this->subject,
        $this->message
    ));

    session()->flash('message', "Thank You! You'r Message. has been Send Successfully");

    $this->reset(['name', 'email', 'phone', 'subject', 'message']);
}


    public function render()
    {
        $connectedEmail = Setting::getValue('email');
        $connectedPhone = Setting::getValue('phone');
        $facebook = Setting::getValue('facebook', '');
        $twitter = Setting::getValue('twitter', '');
        $instagram = Setting::getValue('instagram', '');
        $whatsapp = Setting::getValue('whatsapp', '');
        $address = Setting::getValue('address', '');
        $location = Setting::getValue('location', '');


        return view('livewire.front.contact', compact('connectedEmail', 'connectedPhone', 'facebook', 'twitter', 'instagram', 'whatsapp','address','location'))->layout('components.front-layout');
    }
}