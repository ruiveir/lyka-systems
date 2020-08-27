<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\RelFornResp;
use App\Responsabilidade;
use Illuminate\Console\Command;

class PaymentStatus extends Command
{
    protected $signature = 'payment:update';
    protected $description = 'Update the payment status on database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
      $fornecedores = RelFornResp::where('estado', '!=', 'Pago')->get();
      foreach ($fornecedores as $fornecedor) {
        if ($fornecedor->dataVencimento != null) {
          if ($fornecedor->dataVencimento < Carbon::now()) {
            RelFornResp::where('idRelacao', $fornecedor->idRelacao)->update(['estado' => 'Dívida']);
          }
        }
      }

      $responsabilidades = Responsabilidade::where('estado', '!=', 'Pago')->get();
      foreach ($responsabilidades as $responsabilidade) {
        if ($responsabilidade->dataVencimentoCliente != null) {
          if ($responsabilidade->dataVencimentoCliente < Carbon::now()) {
            Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)->update(['estado' => 'Dívida']);
          }
        }

        if ($responsabilidade->dataVencimentoAgente != null) {
          if ($responsabilidade->dataVencimentoAgente < Carbon::now()) {
            Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)->update(['estado' => 'Dívida']);
          }
        }

        if ($responsabilidade->dataVencimentoSubAgente != null) {
          if ($responsabilidade->dataVencimentoSubAgente < Carbon::now()) {
            Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)->update(['estado' => 'Dívida']);
          }
        }

        if ($responsabilidade->dataVencimentoUni1 != null) {
          if ($responsabilidade->dataVencimentoUni1 < Carbon::now()) {
            Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)->update(['estado' => 'Dívida']);
          }
        }

        if ($responsabilidade->dataVencimentoUni2 != null) {
          if ($responsabilidade->dataVencimentoUni2 < Carbon::now()) {
            Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)->update(['estado' => 'Dívida']);
          }
        }
      }
    }
}
