<?php

namespace App\Http\Requests\Product;

use App\Dto\Filters\FilterItemDto;
use App\Dto\Filters\FiltersDto;
use App\Dto\Product\GetProductsDto;
use App\Dto\Sort\SortItemDto;
use App\Dto\Sort\SortsDto;
use Illuminate\Foundation\Http\FormRequest;

class GetProductsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'per_page' => 'sometimes|integer',
            'page' => 'sometimes|integer|min:1',
            'sort' => 'sometimes|string|in:price_asc,price_desc,created_at_desc,created_at_asc',
            'price_from' => 'sometimes|nullable|numeric|min:0',
            'price_to' => 'sometimes|nullable|numeric|min:0',
            'category' => 'sometimes|nullable|string',
        ];
    }

    public function toDto()
    {
        $filterItems = [];
        foreach ($this->input('filters', []) as $filter) {
            $filterItems[] = new FilterItemDto(
                column: $filter['column'],
                operator: $filter['operator'],
                value: $filter['value']
            );
        }
        $filtersDto = new FiltersDto($filterItems);

        $sortItems = [];
        foreach ($this->input('sorts', []) as $sort) {
            $sortItems[] = new SortItemDto(
                column: $sort['column'] ?? 'created_at',
                direction: $sort['direction'] ?? 'desc',
            );
        }
        $sortDto = new SortsDto($sortItems);

        return new GetProductsDto(
            perPage: (int)$this->input('per_page', 20),
            page: (int)$this->input('page', 1),
            sorts: $sortDto,
            filters: $filtersDto,
        );
    }
}
