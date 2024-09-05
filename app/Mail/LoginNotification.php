<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class LoginNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $ipAddress;
    public $time;

    public function __construct($user, $ipAddress, $time)
    {
        $this->user = $user;
        $this->ipAddress = $ipAddress;
        $this->time = $time;
    }

    public function build()
    {
        return $this->subject('Inlognotificatie')
            ->view('emails.login-notification');
    }
}

