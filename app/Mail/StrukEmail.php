<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Profile; // Tambahkan model Profile

class StrukEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $penjualan;
    public $profile;

    public function __construct($penjualan)
    {
        $this->penjualan = $penjualan;
        $this->profile = Profile::first(); // Ambil profil pertama dari database
    }

    public function build()
    {
        return $this->subject('Struk Pembelian Anda')
            ->view('emails.struk')
            ->with([
                'penjualan' => $this->penjualan,
                'profile' => $this->profile
            ]);
    }
}
