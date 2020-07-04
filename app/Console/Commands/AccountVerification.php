<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AccountVerification extends Command
{
    protected $signature = 'account:verification';

    protected $description = 'Check if some account is inactive';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $currentdate = date_create(date('d-m-Y'));
        $users = User::all();
        foreach ($users as $user) {
          $accountcreatedate = date_create(date('d-m-Y', strtotime($user->created_at)));
          $datediff = (date_diff($currentdate,$accountcreatedate))->m;
            if ($user->estado == false && $datediff != 0) {
                User::where('idUser', $user->idUser)->update(['auth_key' => null]);
            }
        }
    }
}
