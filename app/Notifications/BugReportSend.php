<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BugReportSend extends Notification
{
    use Queueable;
    public $name;
    public $idReport;

    public function __construct($name, $idReport)
    {
        $this->name = $name;
        $this->idReport = $idReport;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return[
            'name' => $this->name,
            'idReport' => $this->idReport,
            'subject' => 'BugReport'
        ];
    }
}
