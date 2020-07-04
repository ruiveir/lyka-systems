<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Abertura extends Notification
{
    use Queueable;
    protected $Code;
    protected $Urgencia;
    protected $DataComeco;
    protected $Tipo;
    protected $DataInicio;
    protected $DataFim;
    protected $Assunto;
    protected $Descricao;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($code, $urgencia, $dataComeco, $tipo, $dataInicio, $dataFim, $assunto, $descricao)
    {
        $this->Code = $code;
        $this->Urgencia = $urgencia;
        $this->DataComeco = $dataComeco;
        $this->Tipo = $tipo;
        $this->DataInicio = $dataInicio;
        $this->DataFim = $dataFim;
        $this->Assunto = $assunto;
        $this->Descricao = $descricao;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [/*'mail',*/'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'code' => $this->Code,
            'urgencia' => $this->Urgencia,
            'dataComeco' => $this->DataComeco,
            'tipo' => $this->Tipo,
            'dataInicio' => $this->DataInicio,
            'dataFim' => $this->DataFim,
            'assunto' => $this->Assunto,
            'descricao' => $this->Descricao,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
