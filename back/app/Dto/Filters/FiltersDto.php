<?php

namespace App\Dto\Filters;

class FiltersDto
{
    /**
     * @param FilterItemDto[]|null $filters ;
     */
    public function __construct(
        public ?array $filters = null,
    )
    {
    }
}
