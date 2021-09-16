<?php

namespace App\Jobs;

use App\Mail\RestorePasswordMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class RestorePassword implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $email;
    protected $name;
    protected $auth_key;

    public function __construct($email, $name, $auth_key)
    {
        $this->email = $email;
        $this->name = $name;
        $this->auth_key = $auth_key;
    }

    public function handle()
    {
        Mail::to($this->email)->send(new RestorePasswordMail($this->name, $this->auth_key));
    }
}
