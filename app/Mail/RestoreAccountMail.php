<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RestoreAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $auth_key;

    public function __construct(string $name, string $auth_key)
    {
        $this->name = $name;
        $this->auth_key = $auth_key;
    }

    public function build()
    {
      return $this->from('lykasystems@gmail.com', 'Lyka Systems')
          ->subject('Lyka Systems | Restaurar Conta - '.$this->name)
          ->markdown('mails.restore-account')
          ->with([
              'name' => $this->name,
              'key' => $this->auth_key,
              'link' => url('/').'/ativacao-conta/'.post_slug($this->name)
          ]);
    }
}
