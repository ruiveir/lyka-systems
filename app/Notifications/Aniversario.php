<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Aniversario extends Notification
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
    public function __construct($codigo, $urgencia, $dataComeco, $tipo, $dataInicio, $dataFim, $assunto, $descricao)
    {
        $this->Code = $codigo;
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
                    ->greeting('Congratulations!!')
                    ->line('Today, a cycle of your life ends and another begins again.')
                    ->line("Make this new start a new opportunity to do everything you've always dreamed of!")
                    ->line('')
                    ->line('')
                    ->greeting('Parabéns')
                    ->line('Hoje um ciclo de sua vida termina e outro recomeça.')
                    ->line('Faça deste novo recomeço uma nova oportunidade para fazer tudo o que sempre sonhou!');
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
