<?php

namespace App\Events;

use App\Responsabilidade;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class StorePayment
{
    use Dispatchable, SerializesModels;

    public $responsabilidade;

    public function __construct(Responsabilidade $responsabilidade)
    {
        $this->responsabilidade = $responsabilidade;
    }
}
