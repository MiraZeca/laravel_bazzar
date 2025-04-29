<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $imageSrc;

    public function __construct($email)
    {
        $this->email = $email;

        // GitHub slika direktan URL
        $this->imageSrc = 'https://raw.githubusercontent.com/MiraZeca/emailimg/f7fe2da4c174d314f7d3c0309da68c10fe55b899/email.jpg';
    }

    public function build()
    {
        return $this->subject('Thank you for subscribing!')
                    ->view('emails.subscription')
                    ->with([
                        'email' => $this->email,
                        'src' => $this->imageSrc, // Direktan URL slike
                    ]);
    }
}
