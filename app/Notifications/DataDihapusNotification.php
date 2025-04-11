<?php


namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class DataDihapusNotification extends Notification
{
    protected $user;
    protected $tabel;
    protected $data_id;

    public function __construct($user, $tabel, $data_id)
    {
        $this->user = $user;
        $this->tabel = $tabel;
        $this->data_id = $data_id;
    }

    public function via($notifiable)
    {
        return ['database']; // Simpan notifikasi di database
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "{$this->user} menghapus data dari tabel {$this->tabel} dengan ID {$this->data_id}.",
        ];
    }
}
