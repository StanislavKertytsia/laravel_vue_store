<?php

namespace App\Dto\Sort;

class SortItemDto
{
    public function __construct(
        public string $column = 'created_at',
        public string $direction = 'desc'
    )
    {
    }
}
