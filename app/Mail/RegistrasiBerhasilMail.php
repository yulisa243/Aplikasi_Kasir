<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrasiBerhasilMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Registrasi Berhasil')
                    ->view('emails.registrasi_berhasil')
                    ->with([
                        'user' => $this->user
                    ]);
    }
}

