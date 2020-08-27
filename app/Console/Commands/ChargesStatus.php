<?php

namespace App\Console\Commands;

use App\Fase;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ChargesStatus extends Command
{
    protected $signature = 'charges:status';
    protected $description = 'Update the status from charges';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $fases = Fase::where('verificacaoPago', false)->get();
        foreach ($fases as $fase) {
            if ($fase->dataVencimento < Carbon::now()) {
                $fase->update(["estado" => "Dívida"]);
            }
        }
    }
}
