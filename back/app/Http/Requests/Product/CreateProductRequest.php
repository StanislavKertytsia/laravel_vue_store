<?php

namespace App\Http\Requests\Product;

use App\Dto\Product\CreateProductDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->check() && in_array('admin', auth()->user()->roles ?? []);
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|file|image',
        ];
    }

    public function toDto()
    {
        return new CreateProductDto(
            title: $this->input('title'),
            description: $this->input('description'),
            price: (float)$this->input('price'),
            image: $this->file('image'),
            stock: (int)$this->input('stock'),
        );
    }
}
