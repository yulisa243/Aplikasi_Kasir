>@php
    namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetUrl;

    public function __construct($resetUrl)
    {
        $this->resetUrl = $resetUrl;
    }

    public function build()
    {
        return $this->view('emails.password_reset')
                    ->with([
                        'resetUrl' => $this->resetUrl,
                    ])
                    ->subject('Password Reset Request');
    }
}
