<?php

namespace App\Dto\Order;

class OrderDto
{
    public function __construct(
        public array   $products,
        public ?string $city = null,
        public ?string $delivery = null,
    )
    {
    }

}
