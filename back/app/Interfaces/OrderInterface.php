<?php

namespace App\Interfaces;

use App\Dto\Order\OrderDto;

interface OrderInterface
{
    function create(string $userId, OrderDto $dto);

}
