<?php

namespace App\Listeners;

use App\Responsabilidade;
use App\Events\StorePayment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentVerification
{
    public function handle(StorePayment $event)
    {
        $responsabilidade = $event->responsabilidade;

        if ($responsabilidade->valorCliente != null) {
            $verificacaoPagoCliente = $responsabilidade->verificacaoPagoCliente;
        }else {
            $verificacaoPagoCliente = 1;
        }

        if ($responsabilidade->valorAgente != null) {
            $verificacaoPagoAgente = $responsabilidade->verificacaoPagoAgente;
        }else {
            $verificacaoPagoAgente = 1;
        }

        if ($responsabilidade->valorSubAgente != null) {
            $verificacaoPagoSubAgente = $responsabilidade->verificacaoPagoSubAgente;
        }else {
            $verificacaoPagoSubAgente = 1;
        }

        if ($responsabilidade->valorUniversidade1 != null) {
            $verificacaoPagoUni1 = $responsabilidade->verificacaoPagoUni1;
        }else {
            $verificacaoPagoUni1 = 1;
        }

        if ($responsabilidade->valorUniversidade2 != null) {
            $verificacaoPagoUni2 = $responsabilidade->verificacaoPagoUni2;
        }else {
            $verificacaoPagoUni2 = 1;
        }

        switch ([$verificacaoPagoCliente, $verificacaoPagoAgente, $verificacaoPagoSubAgente, $verificacaoPagoUni1, $verificacaoPagoUni2]) {
            case $verificacaoPagoCliente == 1 && $verificacaoPagoAgente == 1 && $verificacaoPagoSubAgente == 1 && $verificacaoPagoUni1 == 1 && $verificacaoPagoUni2 == 1:
                Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)
                ->update(['estado' => 'pago']);
                break;
        }
    }
}
