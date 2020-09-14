<?php

namespace App\Listeners;

use App\Events\StoreCharge;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChargeVerification
{
    public function handle(StoreCharge $event)
    {
        $produto = $event->product;
        $fases = $produto->fase;
        $number = count($fases);

        $pago = 0;
        foreach ($fases as $fase) {
            if ($fase->estado == "Pago" && $fase->verificacaoPago == true) {
                $pago++;
            }

            if ($fase->estado != "Dívida") {
                $produto->update(["estado" => "Pendente"]);
            }elseif ($fase->estado == "Dívida") {
                $produto->update(["estado" => "Dívida"]);
            }
        }

        if ($pago == $number) {
            $produto->update(["estado" => "Pago"]);
        }
    }
}
