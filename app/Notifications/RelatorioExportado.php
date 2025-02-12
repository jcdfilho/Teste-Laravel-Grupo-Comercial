<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RelatorioExportado extends Notification implements ShouldQueue
{
    use Queueable;

    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'file_path' => $this->filePath,
            'message' => 'Seu relatório foi exportado com sucesso. Clique para baixar.',
        ];
    }
}
