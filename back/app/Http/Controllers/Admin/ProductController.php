<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\GetProductsRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductInterface;

class ProductController extends Controller
{
    public function __construct(
        protected ProductInterface $service
    )
    {
    }

    public function index(GetProductsRequest $request)
    {
        $dto = $request->toDto();
        $products = $this->service->all($dto);
        return ProductResource::collection($products);
    }

    public function store(CreateProductRequest $request)
    {
        $dto = $request->toDto();
        $product = $this->service->create($dto);
        return new ProductResource($product);
    }

    public function show(string $id)
    {
        //
    }


    public function update(UpdateProductRequest $request, string $id)
    {
        $dto = $request->toDto();
        $product = $this->service->update($dto, $id);
        return new ProductResource($product);
    }

    public function destroy(string $id)
    {
        $product = $this->service->delete($id);
        return new ProductResource($product);
    }
}
