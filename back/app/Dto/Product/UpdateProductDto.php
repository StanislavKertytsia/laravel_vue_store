<?php

namespace App\Dto\Product;

class UpdateProductDto
{
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public ?float  $price = null,
        public ?int    $stock = null,
        public ?string $image = null,
    )
    {
    }
}
