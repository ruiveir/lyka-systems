<?php

namespace App\Jobs;

use Mail;
use App\User;
use Illuminate\Bus\Queueable;
use App\Mail\SendEmailConfirmation;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $name;
    protected $auth_key;

    public function __construct(string $email, string $name, string $auth_key)
    {
        $this->email = $email;
        $this->name = $name;
        $this->auth_key = $auth_key;
    }

    public function handle()
    {
        Mail::to($this->email)->send(new SendEmailConfirmation($this->name, $this->auth_key));
    }
}
