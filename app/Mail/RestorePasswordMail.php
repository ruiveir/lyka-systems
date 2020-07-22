<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RestorePasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $auth_key;

    public function __construct($name, $auth_key)
    {
        $this->name = $name;
        $this->auth_key = $auth_key;
    }

    public function build()
    {
      return $this->from('lykasystems@mail.com', 'Lyka Systems')
          ->subject('Lyka Systems | Restaurar palavra-chave - '.$this->name)
          ->markdown('mails.restore-password')
          ->with([
              'name' => $this->name,
              'key' => $this->auth_key,
              'link' => url('/').'/restaurar-password/'.post_slug($this->name)
          ]);
    }
}
