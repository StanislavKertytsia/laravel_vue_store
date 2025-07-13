<?php

namespace App\Dto\Filters;

class FilterItemDto
{
    public function __construct(
        public string    $column,
        public string    $operator,
        public int|float $value,
    )
    {
    }
}
