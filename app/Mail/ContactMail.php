<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

   public $name, $email, $subject, $message;

public function __construct($name, $email, $subject, $message)
{
    $this->name = $name;
    $this->email = $email;
    $this->subject = $subject;
    $this->message = $message;
}

public function build()
{
    return $this->from('aboskndr0956@gmail.com', 'Amara Food') // إيميل المرسل
                ->replyTo($this->email, $this->name)          // الإيميل تبع المرسل من الفورم
                ->to('aboskndr0956@gmail.com')                // الإيميل اللي بدك يروح عليه
                ->subject($this->subject)
                ->markdown('emails.contact');
}

}
