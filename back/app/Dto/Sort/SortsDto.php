<?php

namespace App\Dto\Sort;

class SortsDto
{
    /**
     * @param SortItemDto[]|null $sorts ;
     */
    public function __construct(
        public ?array $sorts = null,
    )
    {
    }
}
