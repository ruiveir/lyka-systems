<?php
namespace App\Jobs;

use Mail;
use App\User;
use Illuminate\Bus\Queueable;
use App\Mail\RestoreAccountMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ConfirmLogin
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $name;
    public $login_key;
    public $user;
    public $email;

    public function __construct(string $email, string $name, string $login_key)
    {
        $this->email = $email;
        $this->login_key = $login_key;
        $this->name = $name;
    }

    public function handle()
    {
        Mail::to($this->email)->send(new LoginEmailConfirmation($this->name, $this->login_key));
    }
}
