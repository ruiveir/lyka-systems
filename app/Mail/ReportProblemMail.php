<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReportProblemMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $phone;
    public $text;
    public $errorfile;

    public function __construct($name, $email, $phone, $text, $errorfile)
    {
      $this->name = $name;
      $this->email = $email;
      $this->phone = $phone;
      $this->text = $text;
      $this->errorfile = $errorfile;
    }

    public function build()
    {
      if ($this->errorfile != null) {
        return $this->from($this->email, $this->name)
            ->subject('Lyka Systems | Relatório de Erro - '.$this->name)
            ->attach($this->errorfile->getRealPath(), [
                    'as' => 'captura-erro.'.$this->errorfile->getClientOriginalExtension(),
                    'mime' => $this->errorfile->getMimeType(),
            ])
            ->markdown('mails.report')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'text' => $this->text,
                'errofile' => $this->errorfile
            ]);
      }else {
        return $this->from($this->email, $this->name)
            ->subject('Lyka Systems | Relatório de erro - '.$this->name)
            ->markdown('mails.report')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'text' => $this->text
            ]);
      }
   }
}
