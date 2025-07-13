<?php

namespace App\Interfaces;

use App\Dto\Product\CreateProductDto;
use App\Dto\Product\GetProductsDto;
use App\Dto\Product\UpdateProductDto;

interface ProductInterface
{
    public function create(CreateProductDto $data);

    public function update(UpdateProductDto $data, string $id);

    public function delete(string $id);

//    public function find( $data);
    public function all(GetProductsDto $data);
//    public function create(array $data);
}
