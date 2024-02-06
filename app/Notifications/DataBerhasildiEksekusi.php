<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class DataBerhasilDieksekusi extends Notification
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Operasi Anda berhasil dieksekusi.')
            ->action('Lihat Detail', url('/'))
            ->line('Terima kasih telah menggunakan layanan kami!');
    }
}
