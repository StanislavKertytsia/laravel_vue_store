<?php

namespace App\Services;

use App\Dto\Filters\FiltersDto;
use App\Dto\Product\CreateProductDto;
use App\Dto\Product\GetProductsDto;
use App\Dto\Product\UpdateProductDto;
use App\Dto\Sort\SortsDto;
use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductService implements ProductInterface
{
    public function create(CreateProductDto $dto)
    {
        $imagePath = $dto->image->store('products', 'public');
        return Product::create([
            'title' => $dto->title,
            'description' => $dto->description,
            'price' => $dto->price,
            'stock' => $dto->stock,
            'image' => $imagePath,
        ]);
    }

    public function delete(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return $product;
    }

    public function update(UpdateProductDto $dto, string $id)
    {
        $product = Product::findOrFail($id);

        $data = array_filter([
            'title' => $dto->title,
            'description' => $dto->description,
            'price' => $dto->price,
            'stock' => $dto->stock,
            'image' => $dto->image,
        ], fn($value) => $value !== null);

        $product->update($data);

        return $product;
    }

    public function all(GetProductsDto $dto)
    {
        $query = Product::query();

        $this->applyFilters($query, $dto->filters);
        $this->applySorting($query, $dto->sorts);

        return $query->paginate($dto->perPage, ['*'], 'page', $dto->page);
    }

    private function applyFilters($query, FiltersDto $dto)
    {
        if (empty($dto?->filters)) return;

        $allowedColumns = ['price', 'category'];
        $allowedOperators = ['=', '>=', '<='];

        foreach ($dto->filters as $filter) {
            if (
                in_array($filter->column, $allowedColumns) &&
                in_array($filter->operator, $allowedOperators)
            ) {
                $query->where($filter->column, $filter->operator, $filter->value);
            }
        }
    }

    private function applySorting($query, SortsDto $dto)
    {
        $allowedColumns = ['price', 'created_at'];
        $allowedDirections = ['asc', 'desc'];

        if (empty($dto->sorts)) {
            $query->orderBy('created_at', 'desc');
            return;
        }
        
        foreach ($dto->sorts as $sortItem) {
            $column = in_array($sortItem->column, $allowedColumns) ? $sortItem->column : 'created_at';
            $direction = in_array($sortItem->direction, $allowedDirections) ? $sortItem->direction : 'desc';
            $query->orderBy($column, $direction);
        }
    }


}
