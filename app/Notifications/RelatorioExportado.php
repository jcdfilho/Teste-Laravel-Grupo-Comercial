<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RelatorioExportado extends Notification
{
    use Queueable;

    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Relatório Exportado')
            ->line('Seu relatório foi exportado com sucesso.')
            ->action('Baixar Relatório', url('/storage/' . $this->filePath))
            ->line('Obrigado por usar nossa aplicação!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'file_path' => $this->filePath,
            'message' => 'Seu relatório foi exportado com sucesso.',
        ];
    }
}
