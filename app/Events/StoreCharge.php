<?php

namespace App\Events;

use App\Produto;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class StoreCharge
{
    use Dispatchable, SerializesModels;

    public $product;

    public function __construct(Produto $product)
    {
        $this->product = $product;
    }
}
