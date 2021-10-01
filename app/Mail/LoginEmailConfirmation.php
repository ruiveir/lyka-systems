<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class LoginEmailConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $login_key;

    public function __construct(string $name, string $login_key)
    {
        $this->name = $name;
        $login_key = rand(10000 , 99999);
        $user->login_key = $login_key;
    }

    public function build()
    {
        return $this->from('lykasystems@gmail.com', 'Lyka Systems')
            ->subject('Lyka Systems | Login Check ')
            ->markdown('mails.loginverification')
            ->with([
                'name' => $this->name,
                'login_key' => $this->login_key,
                'link' => url('/login-verification/' . post_slug($this->name))
            ]);
    }
}
