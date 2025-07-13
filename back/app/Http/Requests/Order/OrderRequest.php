<?php

namespace App\Http\Requests\Order;

use App\Dto\Order\OrderDto;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'products' => ['required', 'array', 'min:1'],
            'products.*.id' => ['required', 'string'],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
            'city' => ['required', 'string'],
            'delivery' => ['required', 'string'],
        ];
    }

    public function toDto()
    {
        return new OrderDto(
            products: $this->validated('products'),
            city: $this->validated('city'),
            delivery: $this->validated('delivery'),
        );
    }
}
