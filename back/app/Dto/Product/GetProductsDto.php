<?php

namespace App\Dto\Product;

use App\Dto\Filters\FiltersDto;
use App\Dto\Sort\SortsDto;

class GetProductsDto
{
    public function __construct(
        public int         $perPage = 15,
        public int         $page = 1,
        public ?SortsDto   $sorts,
        public ?FiltersDto $filters = null,
    )
    {
    }
}
