<?php

namespace App\Jobs;

use Mail;
use Illuminate\Bus\Queueable;
use App\Mail\ReportProblemMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendReportMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $phone;
    protected $text;
    protected $errorfile;

    public function __construct($name, $email, $phone, $text, $errorfile)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->text = $text;
        $this->errorfile = $errorfile;
    }

    public function handle()
    {
        Mail::to("lykasystems@mail.com")->send(new ReportProblemMail($this->name, $this->email, $this->phone, $this->text, $this->errorfile));
    }
}
