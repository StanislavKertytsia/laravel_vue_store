<?php

namespace App\Http\Requests\Product;

use App\Dto\Product\UpdateProductDto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->check() && in_array('admin', auth()->user()->roles ?? []);
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes||string',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
            'image' => 'sometimes|nullable|string',
        ];
    }

    public function toDto()
    {
        return new UpdateProductDto(
            title: $this->title,
            description: $this->description,
            price: $this->price,
            stock: $this->stock,
            image: $this->image,
        );
    }
}
