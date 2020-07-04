<?php

namespace App\Jobs;

use Mail;
use App\User;
use Illuminate\Bus\Queueable;
use App\Mail\RestorePasswordMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RestorePassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $name;

    public function __construct(string $email, string $name)
    {
        $this->email = $email;
        $this->name = $name;
    }

    public function handle()
    {
        Mail::to($this->email)->send(new RestorePasswordMail($this->name));
    }
}
