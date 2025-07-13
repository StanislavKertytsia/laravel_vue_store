<?php

namespace App\Dto\Product;

use Illuminate\Http\UploadedFile;

class CreateProductDto
{
    public function __construct(
        public string       $title,
        public string       $description,
        public float        $price,
        public UploadedFile $image,
        public int          $stock
    )
    {
    }
}
